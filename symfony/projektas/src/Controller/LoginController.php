<?php
namespace App\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
class LoginController extends Controller
{
    /**
     * @param Request $request
     * @param AuthenticationUtils $authenticationUtils
     * @param AuthorizationCheckerInterface $authChecker
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function login(Request $request, AuthenticationUtils $authenticationUtils, AuthorizationCheckerInterface $authChecker)
    {
        if ($authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('main');
        }
        $lastUsername = $authenticationUtils->getLastUsername();
        //var_dump($lastUsername); die();
        if($lastUsername != null)
        {
            $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['email'=>$lastUsername]);
            if($user != null && $user->getIsDeleted())
            {
                return $this->render('login.html.twig', array(
                    'last_username' => $lastUsername,
                    'error' => 'This user is banned.',
                ));
            }
        }
        $error = $authenticationUtils->getLastAuthenticationError();
        //var_dump($error); die();
        if ($error)
        {
            $error = "Wrong username or password";
        }
        return $this->render('login.html.twig', array(
            'last_username' => $lastUsername,
            'error' => $error,
        ));
    }
    /**
     * @Route("/logout", name="logout")
     */
    public function logout()
    {
    }
}