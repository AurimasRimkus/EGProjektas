<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Entity\Hotel;
use App\Form\HotelNetworkReportType;
use App\Form\HotelType;
use App\Entity\HotelNetworkReport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class HotelsController extends AbstractController
{
    public function index()
    {
        return new Response(
            'Main page'
        );
    }

    public function showList()
    {
        $allHotels = $this->getDoctrine()->getRepository(Hotel::class)->findAll();
        return $this->render('hotelsList.html.twig', [
            'hotels' => $allHotels,
        ]);
    }
	
    public function showNetworkEmployeesList()
    {
        return $this->render('networkEmployeesList.html.twig', [
        ]);
    }

    public function showAddHotelForm(Request $request)
    {
        $newHotel = new Hotel();
        $form = $this->createForm(HotelType::class, $newHotel);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($newHotel);
            
            $em->flush();
            return $this->render('hotelsList.html.twig', array(
                'success'=> "Account created succesfully",
                'error' => null
            ));
        }
        return $this->render('hotelsForm.html.twig', array(
           'form'=>$form->createView(),
           'error'=>null
        ));
    }
	
    public function showHotelNetworkReport()
    {
        $newReport = new HotelNetworkReport();
        $form = $this->createForm(HotelNetworkReportType::class, $newReport);
        return $this->render('hotelNetworkReport.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
