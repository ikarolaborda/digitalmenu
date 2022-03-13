<?php

namespace App\Controller;

use App\Repository\DishRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(DishRepository $dishRepository): Response
    {
        $dishes = $dishRepository->findAll();
        $randomDish = array_rand($dishes, 2);

        return $this->render('home/index.html.twig', [
            'dish01' => $dishes[$randomDish[0]],
            'dish02' => $dishes[$randomDish[1]],
        ]);
    }

}
