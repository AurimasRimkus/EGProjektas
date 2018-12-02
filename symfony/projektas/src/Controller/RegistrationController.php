<?php
namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
/**
 * Class RegistrationController
 * @package App\Controller
 */
class RegistrationController extends Controller
{
    /**
     * @Route("/register", name="register")
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @param AuthorizationCheckerInterface $authChecker
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function register(Request $request, UserPasswordEncoderInterface $encoder, AuthorizationCheckerInterface $authChecker, \Swift_Mailer $mailer)
    {
        if ($authChecker->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('index');
        }
        $user = new User();
        $form = $this->createForm(SystemUserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $password = $encoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
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
            $em->persist($user);
            $em->flush();
            return $this->render('login.html.twig', array(
                'success'=> "User ". $user->getEmail(). " was created.",
                'last_username' => $user->getEmail()
            ));
        }
        return $this->render('register.html.twig', array(
           'form'=>$form->createView(),
        ));
    }
    /**
     * @Route("/activate/{token}", name="activateAccount")
     */
    public function Activate(Request $request, $token)
    {
        $user = $this->getDoctrine()->getRepository(User::class)->findOneBy(['registrationToken' => $token]);
        if($user == null)
        {
            return $this->redirectToRoute('index');
        }
        $em = $this->getDoctrine()->getManager();
        $user->setIsActive(true);
        $user->setRegistrationToken(null);
        $em->flush();
        return $this->redirectToRoute('login');
    }
    /**
     * @Route("/resend/", name="resendActivationMail")
     */
    public function resendActivationMail(\Swift_Mailer $mailer){
        $user = $this->getUser();
        if($user == null || $user->getIsActive() == true){
            return $this->render('index.html.twig', array(
                'error'=>'Your account is already activated',
            ));
        }
        $send = $this->get('app.email_activation_service');
        $send->SendActivationEmail($user->getUsername(), $user->getEmail(), $user->getRegistrationToken(), $mailer);
        return $this->render('index.html.twig', array(
           'success'=>'Activation e-mail resent!',
        ));
    }
}