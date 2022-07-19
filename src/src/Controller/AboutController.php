<?php

namespace App\Controller;

use Doctrine\Common\Lexer\AbstractLexer;
use Exception;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/about')]
class AboutController extends AbstractController
{


  #[Route('/{_locale}', name: 'about_index', methods: ['GET'] , defaults:['_locale'=>'en'])] 
    public function index(): Response
    {
      return $this->render('/about/index.html.twig');
    }
}