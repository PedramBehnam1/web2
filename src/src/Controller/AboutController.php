<?php

namespace App\Controller;

use Doctrine\Common\Lexer\AbstractLexer;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class AboutController extends AbstractController
{


   /**
    * 
    * @Route("/about", methods={"GET"})
    *
    * @return Response
    * @throws \Exception
    */
    public function index(): Response
    {
      return $this->render('/about/index.html.twig');
    }
}