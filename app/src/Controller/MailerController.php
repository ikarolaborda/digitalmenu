<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailerController extends AbstractController
{
    /**
     * @Route("/mailer", name="mail")
     */
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
            ->from('mesa01@digitalmenu.wip')
            ->to('waiter@digitalmenu.wip')
            ->subject('Pedido')
            ->text('Extra fries');

        $mailer->send($email);
        return new Response('email enviado');
    }
}
