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
            $image = $request->files->get('dish')['image'];
            if($image) {
                $filename = md5(uniqid()).'.'.$image->guessClientExtension();
            }

            $image->move(
                $this->getParameter('images_folder'),
                $filename
            );

            $dish->setImage($filename);

            $em->persist($dish);
            $em->flush();
            $this->addFlash("dishCreated","O prato solicitado foi criado com sucesso");
            return $this->redirect($this->generateUrl('dish.dish_main'));
        }


        return $this->render('dish/create.html.twig', [
            'createForm' => $form->createView()
        ]);
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id, DishRepository $dishRepository)
    {
        $em = $this->getDoctrine()->getManager();
        $dish = $dishRepository->find($id);
        $em->remove($dish);
        $em->flush();
        $this->addFlash("dishDeleted","O prato solicitado foi removido");
        return $this->redirect($this->generateUrl('dish.dish_main'));
    }

    /**
     * @Route("/show/{id}", name="show")
     */
    public function show(Dish $dish)
    {
        return $this->render('dish/show.html.twig', [
            'dish' => $dish
        ]);
    }

}
