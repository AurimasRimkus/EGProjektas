<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Warehouse;
use App\Entity\Order;
use App\Form\HotelNetworkReportType;
use App\Form\ItemRemoveType;
use App\Form\ItemType;
use App\Form\ItemUseForOrder;
use App\Form\OrderType;
use App\Form\WarehouseType;
use App\Entity\HotelNetworkReport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\Routing\Annotation\Route;


class WarehouseController extends AbstractController
{

    public function index()
    {
        return new Response(
            'Main page'
        );
    }

    public function showList()
    {
        return $this->render('warehousesList.html.twig', [
        ]);
    }
    public function showItemsList()
    {
        $allItems = $this->getDoctrine()->getRepository(Item::class)->findAll();
        return $this->render('itemsList.html.twig', [
            'items' => $allItems,
        ]);
    }
    public function showOrdersList()
    {
        $allOrders = $this->getDoctrine()->getRepository(Order::class)->findAll();
        return $this->render('ordersList.html.twig', [
            'orders' => $allOrders,
        ]);
    }

    /**
     * @Route("/deleteItem/{id}", name="deleteItem")
     */
    public function deleteItem($id)
    {
        $item = $this->getDoctrine()->getRepository(Item::class)->find($id);
        $this->getDoctrine()->getManager()->remove($item);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('itemList');
    }
    /**
     * @Route("/deleteOrder/{id}", name="deleteOrder")
     */
    public function deleteOrder($id)
    {
        $order = $this->getDoctrine()->getRepository(Order::class)->find($id);
        $this->getDoctrine()->getManager()->remove($order);
        $this->getDoctrine()->getManager()->flush();
        return $this->redirectToRoute('ordersList');
    }

    /**
 * @Route("/editItem/{id}", name="editItem")
 */
    public function editItem(Request $request, $id)
    {
        $item = $this->getDoctrine()->getRepository(Item::class)->find($id);
        $form = $this->createForm(ItemType::class, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('itemList');
        }
        return $this->render('itemsEdit.html.twig', array(
            'form' => $form->createView(),
            'action' => "Edit",
        ));
    }
    /**
     * @Route("/useForOrder/{id}", name="useForOrder")
     */
    public function useForOrder(Request $request, $id)
    {
        $order = $this->getDoctrine()->getRepository(Order::class)->find($id);
        $item = new Item();
        $form = $this->createForm(ItemUseForOrder::class, $item);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {

            try {
                $idd = $item->getId();
                $itemToAdd = $this->getDoctrine()->getRepository(Item::class)->find($idd);
                $order->addItem($itemToAdd);
                $itemToAdd->reduceAmount($item->getAmount());

                //$item = new Item();
                //$form = $this->createForm(ItemType::class, $item);
                return $this->render('ordersList.html.twig', array(
                    'success'=> "Item was added.",
                    'form'=>$form->createView(),
                    'error' => null
                ));

            }
            catch (\Throwable $e) {
                return $this->render('itemForm.html.twig', array(
                    'form' => $form->createView(),
                    'error' => 'Failed to upload item data',
                    'success' => null
                ));

            }
        }
        return $this->render('itemForm.html.twig', array(
            'form'=>$form->createView(),
            'error'=>null,
            'success'=>null
        ));
    }
    /**
     * @Route("/editOrder/{id}", name="editOrder")
     */
    public function editOrder(Request $request, $id)
    {
        $order = $this->getDoctrine()->getRepository(Order::class)->find($id);
        $form = $this->createForm(OrderType::class, $order);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('ordersList');
        }
        return $this->render('itemsEdit.html.twig', array(
            'form' => $form->createView(),
            'action' => "Edit",
        ));
    }
    /**
     * @Route("/viewOrderItems/{id}", name="viewOrderItems")
     */
    public function viewOrderItems(Request $request, $id)
    {
        $order = $this->getDoctrine()->getRepository(Order::class)->find($id);
        $allItems = $order->getItems();
        return $this->render('orderItemsList.html.twig', [
            'order' => $id,
            'items' => $allItems,
        ]);
    }
    /**
     * @Route("/removeItem/{id}", name="removeItem")
     */
    public function removeItem(Request $request, $id)
    {//nurašyti
        $item = $this->getDoctrine()->getRepository(Item::class)->find($id);
        $form = $this->createForm(ItemRemoveType::class, $item);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            return $this->redirectToRoute('itemList');
        }
        return $this->render('itemsEdit.html.twig', array(
            'form' => $form->createView(),
            'action' => "Remove",
        ));
    }
    public function showWarehouseMenu()
    {
        return $this->render('warehouseManagement.html.twig', [
        ]);
    }


    public function showAddItemForm(Request $request) {

        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($item);
                $em->flush();
                $name = $item->getName();
                $item = new Item();
                $form = $this->createForm(ItemType::class, $item);
                return $this->render('itemForm.html.twig', array(
                    'success'=> "Item ". $name. " was created.",
                    'form'=>$form->createView(),
                    'error' => null
                ));

            }
            catch (\Throwable $e) {
                return $this->render('itemForm.html.twig', array(
                    'form' => $form->createView(),
                    'error' => 'Failed to upload item data',
                    'success' => null
                ));

            }
        }
        return $this->render('itemForm.html.twig', array(
            'form'=>$form->createView(),
            'error'=>null,
            'success'=>null
        ));
    }
    /**
     * @Route("/addOrderItem/{id}", name="editItem")
     */
    public function showAddOrderItem(Request $request, $id) {

        $item = new Item();
        $form = $this->createForm(ItemType::class, $item);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($item);
                $em->flush();
                $name = $item->getName();
                $item = new Item();
                $form = $this->createForm(ItemType::class, $item);
                return $this->render('itemForm.html.twig', array(
                    'success'=> "Item ". $name. " was created.",
                    'form'=>$form->createView(),
                    'error' => null
                ));
                return $this->redirectToRoute('itemsList');
            }
            catch (\Throwable $e) {
                return $this->render('itemForm.html.twig', array(
                    'form' => $form->createView(),
                    'error' => 'Failed to upload item data',
                    'success' => null
                ));

            }
        }
        return $this->render('itemForm.html.twig', array(
            'form'=>$form->createView(),
            'error'=>null,
            'success'=>null
        ));
    }
    public function showAddOrderForm(Request $request) {

        $order = new Order();
        $form = $this->createForm(OrderType::class, $order);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            try {
                $em->persist($order);
                $em->flush();
                $name = $order->getId();
                $order = new Order();
                $form = $this->createForm(OrderType::class, $order);
                return $this->render('orderForm.html.twig', array(
                    'success'=> "Order ". $name. " was created.",
                    'form'=>$form->createView(),
                    'error' => null
                ));
                return $this->redirectToRoute('ordersList');
            }
            catch (\Throwable $e) {
                return $this->render('orderForm.html.twig', array(
                    'form' => $form->createView(),
                    'error' => 'Failed to upload item data',
                    'success' => null
                ));

            }
        }
        return $this->render('orderForm.html.twig', array(
            'form'=>$form->createView(),
            'error'=>null,
            'success'=>null
        ));
    }

    public function showAddWarehouseForm()
    {
        $newWarehouse = new Warehouse();
        $form = $this->createForm(WarehouseType::class, $newWarehouse);
        return $this->render('warehouseForm.html.twig', [
            'form' => $form->createView()
        ]);
    }
    public function report() {
        $allOrders = $this->getDoctrine()->getRepository(Order::class)->findAll();
        return $this->render('monthlyWarehouseReport.html.twig', ['orders' => $allOrders]);
    }
}
