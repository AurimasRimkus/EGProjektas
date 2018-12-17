<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Discount;
use App\Form\DiscountType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class DiscountController extends AbstractController
{
    public function index()
    {
        return new Response(
            'Main page'
        );
    }

    public function showList()
    {
        return $this->render('discountsList.html.twig', [
            'discounts' => $this->getDoctrine()->getRepository(Discount::class)->findAll(),
        ]);
    }


    public function deleteDiscount($id)
    {
        $discount = $this->getDoctrine()->getRepository(Discount::class)->find($id);
        $this->getDoctrine()->getManager()->remove($discount);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('discountsList');
    }


    public function showAddDiscount(Request $request)
    {
        $newDiscount = new Discount();
        $form = $this->createForm(DiscountType::class, $newDiscount);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newDiscount);
            
            $em->flush();
            return $this->render('discountsList.html.twig', array(
                'success'=> "Reservation created successfully",
                'discounts' => $this->getDoctrine()->getRepository(Discount::class)->findAll(),
                'error' => null
            ));
        }
        return $this->render('addDiscountForm.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
