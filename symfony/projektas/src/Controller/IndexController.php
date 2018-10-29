<?php

namespace App\Controller;

use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class IndexController extends AbstractController
{
    public function index()
    {
        return new Response(
            'Main page'
        );
    }

    public function show()
    {
        return $this->render('index.html.twig', [
            'kintamasis' => 'kazkoks random kinatamasis',
        ]);
    }
}
