<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\User;
use App\Entity\DayReport;
use App\Form\EmployeeType;
use App\Form\DayReportType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class EmployeesController extends AbstractController
{
    public function index()
    {
        return new Response(
            'Main page'
        );
    }

    public function showList()
    {
        return $this->render('employeesList.html.twig', [
        ]);
    }

    public function showAddEmployeeForm()
    {
        $newEmployee = new User();
        $form = $this->createForm(EmployeeType::class, $newEmployee);
        return $this->render('employeesForm.html.twig', [
            'form' => $form->createView()
        ]);
    }

    public function showDayReport()
    {
        $newDayReport = new DayReport();
        $form = $this->createForm(DayReportType::class, $newDayReport);
        return $this->render('newDayReport.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
