<?php

namespace App\Controller;

use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\Response;


class IndexController extends AbstractController
{
    public function index()
    {
        return new Response(
            'Main page'
        );
    }

     /**
     * @param AuthorizationCheckerInterface $authChecker
     */
    public function show(AuthorizationCheckerInterface $authChecker)
    {
        if ($authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('mainMenu');
        }
        return $this->render('index.html.twig', []);
    }

    public function afterLogin()
    {
        return $this->render('mainPage.html.twig', []);
    }
}
