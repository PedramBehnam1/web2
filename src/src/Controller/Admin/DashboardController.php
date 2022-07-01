<?php

namespace App\Controller\Admin;

use App\Entity\Attraction;
use App\Entity\Comment;
use App\Entity\Event;
use App\Entity\Hotel;
use App\Entity\Location;
use App\Entity\Room;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Travel'); 
    }

    public function configureMenuItems(): iterable
    {
        return [
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),

            MenuItem::section('User'), 
            MenuItem::linkToCrud('Users', 'fa fa-list', User::class),
            MenuItem::section('Attraction'), 
            MenuItem::linkToCrud('Attractions', 'fa fa-list', Attraction::class),
            MenuItem::section('Location'), 
            MenuItem::linkToCrud('Locations', 'fa fa-list', Location::class),
            MenuItem::section('Event'), 
            MenuItem::linkToCrud('Events', 'fa fa-list', Event::class),
            MenuItem::section('Hotel'), 
            MenuItem::linkToCrud('Hotels', 'fa fa-list', Hotel::class),
            MenuItem::section('Room'), 
            MenuItem::linkToCrud('Rooms', 'fa fa-list', Room::class),
            MenuItem::section('Comment'), 
            MenuItem::linkToCrud('Comments', 'fa fa-list', Comment::class),
        ]; 
    }
}
