<?php

namespace App\Controller;

use App\Entity\MyDataBase;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class LoginController extends AbstractController
{
//    /**
//     * @Route("/login", name="login")
//     */
//    public function index()
//    {
//        return $this->render('login/index.html.twig', [
//            'controller_name' => 'LoginController',
//        ]);
//    }

    /**
     * @Route("/login/create", name="LoginCreate")
     */
    public function createLogin(){
        $manager = $this->getDoctrine()->getManager();
        $myDB = new MyDataBase();
        $myDB->setEmail("admin@admin.ru");
        $myDB->setPassword("admin");

        $manager->persist($myDB);
        $manager->flush();

        return new Response($myDB->getId());
    }



}
