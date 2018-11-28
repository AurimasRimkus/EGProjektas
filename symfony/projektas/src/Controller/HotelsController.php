<?php

namespace App\Controller;

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
        return $this->render('hotelsList.html.twig', [
        ]);
    }
	
    public function showNetworkEmployeesList()
    {
        return $this->render('networkEmployeesList.html.twig', [
        ]);
    }

    public function showAddHotelForm()
    {
        $newHotel = new Hotel();
        $form = $this->createForm(HotelType::class, $newHotel);
        return $this->render('hotelsForm.html.twig', [
            'form' => $form->createView()
        ]);
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
