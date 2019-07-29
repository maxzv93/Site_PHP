<?php

namespace App\Controller;


use App\Services\TestService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Psr\Log\LoggerInterface;


class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(TestService $service,LoggerInterface $logger)
    {
        //$tmp = "test";

        $logger->info("proba log");
        $tmp = $service->convert(1000);
        //return new Response("<html><head></head><body>13456789</body></html> ");
        return $this->render('main/index.html.twig',[
            'key'=>$tmp
        ]);
    }

}
