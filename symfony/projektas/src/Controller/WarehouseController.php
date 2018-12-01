<?php

namespace App\Controller;

use App\Entity\Item;
use App\Entity\Warehouse;
use App\Entity\Order;
use App\Form\HotelNetworkReportType;
use App\Form\ItemType;
use App\Form\WarehouseType;
use App\Entity\HotelNetworkReport;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


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
        return $this->render('itemsList.html.twig', [
        ]);
    }
    public function showOrdersList()
    {
        return $this->render('ordersList.html.twig', [
        ]);
    }
    public function showWarehouseMenu()
    {
        return $this->render('warehouseManagement.html.twig', [
        ]);
    }

    public function showAddItemForm()
    {
        $newItem = new Item();
        $form = $this->createForm(ItemType::class, $newItem);
        return $this->render('itemForm.html.twig', [
            'form' => $form->createView()
        ]);
    }
    public function showAddWarehouseForm()
    {
        $newWarehouse = new Warehouse();
        $form = $this->createForm(WarehouseType::class, $newWarehouse);
        return $this->render('warehouseForm.html.twig', [
            'form' => $form->createView()
        ]);
    }
    public function showHotelNetworkReport()
    {
        $newReport = new HotelNetworkReport();
        $form = $this->createForm(HotelNetworkReportType::class, $newReport);
        return $this->render('hotelNetworkReport.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
