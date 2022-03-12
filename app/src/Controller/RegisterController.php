<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegisterController extends AbstractController
{
    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request, UserPasswordHasherInterface $encoder): Response
    {
        $registrationForm = $this->createFormBuilder()
            ->add('username',TextType::class,['label' => 'Nome do usuário/login'])
            ->add('password',RepeatedType::class,[
                'type' => PasswordType::class,
                'required' => true,
                'first_options' => ['label' => 'Senha'],
                'second_options' => ['label' => 'Repita a Senha']
            ])
            ->add('register',SubmitType::class,['label' => 'Cadastrar usuário'])
        ->getForm();

        $registrationForm->handleRequest($request);
        if($registrationForm->isSubmitted()) {
            $inputs = $registrationForm->getData();
            $user = new User();
            $user->setUsername($inputs['username']);
            $user->setPassword($encoder->hashPassword($user,$inputs['password']));

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            $this->addFlash("userCreated","Usuário cadastrado com sucesso, Aguarde aprovação da chefia!");
        }

        return $this->render('register/index.html.twig', [
            'registrationForm' => $registrationForm->createView()
        ]);
    }
}
