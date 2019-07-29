<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RandomNumberController extends AbstractController
{
    /**
     * @Route("/random/{min}/{max}", name="random_number")
     */
    public function index($min, $max)
    {
        $number = random_int($min, $max);

//        return new Response(
//
//            '<html><body>Случайное число: '.$number.'</body></html>'
//
//        );
        return $this->render('random_number/index.html.twig', [
            'controller_name' => 'RandomNumberController',
            'key_number' => $number,
        ]);
    }
}
