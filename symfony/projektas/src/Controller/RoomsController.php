<?php

namespace App\Controller;

use App\Entity\Hotel;
use App\Entity\Room;
use App\Form\RoomType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;


class RoomsController extends AbstractController
{
    public function index()
    {
        return new Response(
            'Main page'
        );
    }

    public function showList()
    {
        return $this->render('roomList.html.twig', [
            'rooms' => $this->getDoctrine()->getRepository(Room::class)->findAll(),
        ]);
    }


    public function showAddRoomForm(Request $request)
    {
        $newRoom = new Room();
        $form = $this->createForm(RoomType::class, $newRoom);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $newRoom->setStatus(1);
            $em->persist($newRoom);
            
            $em->flush();
            return $this->render('mainPage.html.twig', array(
                'success'=> "Room created successfully",
                'error' => null
            ));
        }
        return $this->render('addRoomForm.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
