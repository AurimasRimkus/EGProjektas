<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\User;
use App\Entity\DayReport;
use App\Form\EmployeeType;
use App\Form\DayReportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class ClientsController extends AbstractController
{
    public function index()
    {
        return new Response(
            'Main page'
        );
    }
    
}
