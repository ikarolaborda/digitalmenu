<?php

namespace App\Controller;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/mailer", name="mail")
     */
    public function sendEmail(MailerInterface $mailer, Request $request): Response
    {
        $emailForm = $this->createFormBuilder()
            ->add('message',TextareaType::class,['attr' => ['rows' => '5'], 'label' => 'Escreva sua Mensagem'])
            ->add('sendMail',SubmitType::class,['label' => 'Enviar Mensagem'])
            ->getForm();

        $emailForm->handleRequest($request);

        if($emailForm->isSubmitted()) {
            $input = $emailForm->getData();

            $table = 'Mesa 1';
            $text = $input['message'];
            $email = (new TemplatedEmail())
                ->from('mesa01@digitalmenu.wip')
                ->to('waiter@digitalmenu.wip')
                ->subject('Pedido')

                ->htmlTemplate('mailer/mailer.html.twig')

                ->context([
                    'table' => $table,
                    'text' => $text
                ]);

            $mailer->send($email);
            $this->addFlash('email_message_sent','Sua mensagem foi Enviada!');
            return $this->redirect($this->generateUrl('mail'));
        }

        return $this->render('mailer/index.html.twig', [
            'emailForm' => $emailForm->createView()
        ]);
    }
}
