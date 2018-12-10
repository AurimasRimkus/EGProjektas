<?php

namespace App\Controller;

use App\Entity\Employee;
use App\Entity\User;
use App\Entity\DayReport;
use App\Form\EmployeeType;
use App\Form\EmployeeProfileType;
use App\Form\DayReportType;
use App\Repository\EmployeeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;


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
        $allEmployees = $this->getDoctrine()->getRepository(Employee::class)->findAll();
        return $this->render('employeesList.html.twig', [
            'employees' => $allEmployees,
        ]);
    }

 /*   public function showAddEmployeeForm()
    {
        $newEmployee = new Employee();
        $form = $this->createForm(EmployeeType::class, $newEmployee);
        return $this->render('employeesForm.html.twig', [
            'form' => $form->createView()
        ]);
    }
*/
    public function showDayReport(Request $request, UserPasswordEncoderInterface $encoder, AuthorizationCheckerInterface $authChecker) {
        $dayReport = new DayReport();
        $form = $this->createForm(DayReportType::class, $dayReport);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $today = new \DateTime();
            $dayReport->setReportDate($today);
            $dayReport->setEmployee($this->getUser()->getEmployeeAccount());
            $em = $this->getDoctrine()->getManager();
            $em->persist($dayReport);
            $em->flush();
            return $this->redirectToRoute('dayReport');
        }
        return $this->render('newDayReport.html.twig', array(
           'form'=>$form->createView(),
           'error'=>null,
           'success'=>null
        ));
    }

    public function showAddEmployeeForm(Request $request, UserPasswordEncoderInterface $encoder, AuthorizationCheckerInterface $authChecker, \Swift_Mailer $mailer) {
       /* if (!$authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('main');
        }*/
        $employee = new Employee();
        $form = $this->createForm(EmployeeType::class, $employee);

        $form->handleRequest($request);
       //var_dump($form); die();
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $password = $encoder->encodePassword($employee->getUser(), $employee->getUser()->getPlainPassword());
            $employee->getUser()->setPassword($password);
            /*
            $time = new \DateTime();
            $user->setRegistrationDate($time);
            $user->setLastLoginTime($time);
            $user->setIsDeleted(false);
            $user->setRole(1);
            // send some mail ?
            $send = $this->get('app.email_activation_service');
            $send->SendActivationEmail($user->getUsername(), $user->getEmail(), $user->getRegistrationToken(), $mailer); 
            // ? ^
            */

            $employee->getUser()->setEmployeeAccount($employee);

            // Calling persist for user because employee entry will be created if email is already in use
            try {
                $em->persist($employee->getUser());               
                $em->persist($employee);
                $em->flush();
                $username = $employee->getUser()->getUsername();
                $employee = new Employee();
                $form = $this->createForm(EmployeeType::class, $employee);
                return $this->render('employeesForm.html.twig', array(
                    'success'=> "Employee ". $username. " was created.",
                    'form'=>$form->createView(),
                    'error' => null
                ));
            }
            catch (\Throwable $e) {
                return $this->render('employeesForm.html.twig', array(
                    'form'=>$form->createView(),
                    'error'=>'User with identical email already exists',
                    'success'=>null
                 ));
              } catch (\Exception $e) { 
                return $this->render('employeesForm.html.twig', array(
                    'form'=>$form->createView(),
                    'error'=>'User with identical email already exists',
                    'success'=>null
                 ));
              }
        }
        return $this->render('employeesForm.html.twig', array(
           'form'=>$form->createView(),
           'error'=>null,
           'success'=>null
        ));
    }

    /**
     * @Route("/deleteEmployee/{id}", name="deleteEmployee")
     */
    public function deleteEmployee($id, AuthorizationCheckerInterface $authChecker)
    {
        if (!$authChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('main');
        }
        $user = $this->getDoctrine()->getRepository(Employee::class)->find($id);
        $this->getDoctrine()->getManager()->remove($user);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('employeesList');
    }

        /**
     * @Route("/editEmployee/{id}", name="editEmployee")
     */
    public function editEmployee(Request $request, $id, AuthorizationCheckerInterface $authChecker)
    {
        if (!$authChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('index');
        }
        $employee = $this->getDoctrine()->getRepository(Employee::class)->find($id);
        $form = $this->createForm(EmployeeProfileType::class, $employee);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            //$foundEmployee = $this->getDoctrine()->getRepository(Employee::class)
            //    ->findOneBy(['name'=>$form->get('name')->getData()]);
            /*
            if ($employee !== null && $foundService->getName() != $serviceName)
            {
                return $this->render('employeesEdit.html.twig', array(
                    'form' => $form->createView(),
                    'action' => "Edit",
                    'error'=>"Service with this name already exist."
                ));
            }
            */
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('employeesList');
        }
        return $this->render('employeesEdit.html.twig', array(
            'form' => $form->createView(),
            'action' => "Edit",
        ));
    }

    public function report() {
        $allEmployees = $this->getDoctrine()->getRepository(Employee::class)->findAll();
        return $this->render('monthlyReport.html.twig', ['employees' => $allEmployees]);
    }
}
