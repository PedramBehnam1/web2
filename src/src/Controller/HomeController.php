<?php

namespace App\Controller;

use Doctrine\Common\Lexer\AbstractLexer;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/')]
class HomeController extends AbstractController
{


   #[Route('/{_locale}', name: 'home_index', methods: ['GET'], defaults:['_locale'=>'en'], requirements: ['_locale' => 'en|fa'])]
    public function index(): Response
    {
       return $this->render('/home/index.html.twig');
    }
}