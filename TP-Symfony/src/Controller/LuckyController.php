<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LuckyController extends AbstractController
{
    /**
     * @Route("/", name="app_home")
     */
    public function index(): Response
    {
        return $this->render('home.html.twig');
    }

    /**
     * @Route("/lucky", name="app_lucky_number")
     */
    public function luckyNumber(): Response
    {
        $number = mt_rand(0,100);
        return $this->render('lucky/index.html.twig', [
            'number' => $number
        ]);
    }

    /**
     * @Route("/time/now", name="app_time")
     */
    public function timeNow(): Response
    {
        $date = new DateTime('now');
        return $this->render('lucky/time.html.twig', [
            'date' => $date->format('d/m/Y H:i:s')
        ]);
    }
}
