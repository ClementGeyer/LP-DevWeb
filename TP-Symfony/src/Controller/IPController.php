<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IPController extends AbstractController
{
    /**
     * @Route("/ip", name="app_ip")
     */
    public function index(Request $request): Response
    {
        return $this->render('ip/index.html.twig', [
            'controller_name' => 'IPController',
            'ip' => $request->getClientIp()
        ]);
    }
}
