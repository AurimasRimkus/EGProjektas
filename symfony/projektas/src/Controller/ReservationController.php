<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Room;
use App\Entity\Discount;
use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class ReservationController extends AbstractController
{
    public function index()
    {
        return new Response(
            'Main page'
        );
    }

    public function showList()
    {
        return $this->render('reservationList.html.twig', [
            'reservations' => $this->getDoctrine()->getRepository(Reservation::class)->findByClient($this->getUser()->getClientAccount()),
        ]);
    }


    public function showAddReservation(Request $request)
    {
        $newReservation = new Reservation();
        $form = $this->createForm(ReservationType::class, $newReservation);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $discount = $this->getDoctrine()->getRepository(Discount::class)->findOneByCode($form['discountCode']->getData());
            $newReservation->setClient($this->getUser()->getClientAccount());
            $newReservation->setDiscount($discount);
            $em->persist($newReservation);
            


            $em->flush();
            return $this->render('mainPage.html.twig', array(
                'success'=> "Reservation created successfully",
                'error' => null
            ));
        }
        return $this->render('addReservationForm.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
