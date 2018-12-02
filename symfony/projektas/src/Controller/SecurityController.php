<?php
// src/Controller/SecurityController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;

class SecurityController extends Controller
{
    public function login(Request $request, AuthenticationUtils $authenticationUtils)
	{
	    // get the login error if there is one
	    $error = $authenticationUtils->getLastAuthenticationError();

	    // last username entered by the user
	    $lastUsername = $authenticationUtils->getLastUsername();

	    return $this->render('login.html.twig', array(
	        'last_username' => $lastUsername,
	        'error'         => $error,
	    ));
	}
}