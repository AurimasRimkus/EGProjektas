<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Service;
use App\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class ServiceController extends AbstractController
{
    public function index()
    {
        return new Response(
            'Main page'
        );
    }

    public function showList()
    {
        return $this->render('servicesList.html.twig', [
            'services' => $this->getDoctrine()->getRepository(Service::class)->findAll(),
        ]);
    }


    public function showAddService(Request $request)
    {
        $newService = new Service();
        $form = $this->createForm(ServiceType::class, $newService);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newService);
            
            $em->flush();
            return $this->render('servicesList.html.twig', array(
                'success'=> "Reservation created successfully",
                'services' => $this->getDoctrine()->getRepository(Service::class)->findAll(),
                'error' => null
            ));
        }
        return $this->render('addServiceForm.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
