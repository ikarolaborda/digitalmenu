<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="order")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findBy(
            ['table_number' => 'Mesa 1']
        );
        return $this->render('order/index.html.twig', [
            'orders' => $orders
        ]);
    }

    /**
     * @Route("/order/{id}", name="orders")
     */
    public function order(Dish $dish)
    {
        $order = new Order();
        $order->setTableNumber("Mesa 1");
        $order->setName($dish->getDishName());
        $order->setOrderNumber($dish->getId());
        $order->setPrice($dish->getPrice());
        $order->setStatus(1);

        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        $this->addFlash('order_item_added','O item '. $order->getName(). ' foi adicionado ao pedido com sucesso!');

        return $this->redirect($this->generateUrl('menu'));
    }
}
