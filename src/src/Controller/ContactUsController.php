<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ContactUsController extends AbstractController
{
    #[Route('/contact/us/{_locale}', name: 'app_contact_us', defaults:['_locale'=>'en'])]
    public function index(): Response
    {
        return $this->render('contact_us/index.html.twig');
    }
}
