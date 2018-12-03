<?php

namespace App\Controller;

use App\Entity\Client;
use App\Entity\User;
use App\Entity\DayReport;
use App\Form\ClientType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;


class ClientsController extends AbstractController
{
    public function index()
    {
        return new Response(
            'Main page'
        );
    }

    public function fillProfileForm(Request $request, AuthorizationCheckerInterface $authChecker)
    {
        if (!$authChecker->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            return $this->redirectToRoute('main');
        }
        $newClient = new Client();
        $form = $this->createForm(ClientType::class, $newClient);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $error = null;
            $user = $this->getUser();
            $client = $user->getClientAccount();
            $client->setName($newClient->getName());
            $client->setSurname($newClient->getSurname());
            $client->setPersonalCode($newClient->getPersonalCode());
            $client->setCreditCard($newClient->getCreditCard());
            $client->setPhoneNumber($newClient->getPhoneNumber());
            $client->setUser($user);
            //$mail = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=>$newProfile->getEmail()]);
            /*
            if($user->getEmail() != $newProfile->getEmail() && $mail == null)
            {
                $client->setEmail($newProfile->getEmail());
                $user->setEmail($newProfile->getEmail());
                $user->setIsActive(false);
                $registrationToken = base64_encode(random_bytes(20));
                $registrationToken = str_replace("/","",$registrationToken); // because / will make errors with routes
                $user->setRegistrationToken($registrationToken);
                $send = $this->get('app.email_activation_service');
                $send->SendActivationEmail($user->getUsername(), $user->getEmail(), $user->getRegistrationToken(), $mailer);
            }
            elseif($user->getEmail() != $newProfile->getEmail())
            {
                $error = 'Email incorrect or already in use';
                return $this->render('editProfile.html.twig', [
                    'error' => $error,
                    'form'=>$form->createView()
                ]);
            }*/
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->persist($client);
            $em->flush();
            return $this->render('fillClientProfile.html.twig', [
                'error' => $error,
                'success' => "Your profile was updated.",
                'form' => $form->createView(),
            ]);
        }
        return $this->render('fillClientProfile.html.twig', [
            'form'=>$form->createView(),
        ]);
    }
}
