<?php

namespace App\Controller;

use App\Form\DishType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Dish;
use App\Repository\DishRepository;

/**
 * Class DishController
 * @package App\Controller
 * @author Ikaro C. Laborda <ikaro.laborda@ausy.pt>
 * @Route("/dish", name="dish.")
 */
class DishController extends AbstractController
{
    /**
     * @Route("/", name="dish_main")
     */
    public function index(DishRepository $dishRepository): Response
    {
        $dishes = $dishRepository->findAll();
        return $this->render('dish/index.html.twig', [
            'controller_name' => 'DishController',
            'dishes' => $dishes
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function create(Request $request)
    {
        $dish = new Dish();
        $form = $this->createForm(DishType::class, $dish);
        $form->handleRequest($request);

        if($form->isSubmitted()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($dish);
            $em->flush();
            return $this->redirect($this->generateUrl('dish.dish_main'));
        }


        return $this->render('dish/create.html.twig', [
            'createForm' => $form->createView()
        ]);
    }
}
