<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class InfoController extends AbstractController
{
    #[Route('/info', name: 'app_info')]
    public function index(): Response
    {
        return $this->render('info/index.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    #[Route('/info/about-us', name:'app_info_about_us')]
    public function about_us(): Response
    {
        return $this->render('info/about_us.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    #[Route('/info/contact-us', name:'app_info_contact_us')]
    public function contact_us(): Response
    {
        return $this->render('info/contact_us.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    #[Route('/info/delivery', name:'app_info_delivery')]
    public function delivery(): Response
    {
        return $this->render('info/delivery.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    #[Route('/info/goods-exchange-and-return', name:'app_info_goods_exchange_and_return')]
    public function goods_exchange_and_return(): Response
    {
        return $this->render('info/goods_exchange_and_return.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    #[Route('/info/product-care', name:'app_info_product_care')]
    public function product_care(): Response
    {
        return $this->render('info/product_care.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }

    #[Route('/info/size-guide', name:'app_info_size_guide')]
    public function size_guide(): Response
    {
        return $this->render('info/size_guide.html.twig', [
            'controller_name' => 'InfoController',
        ]);
    }
}
