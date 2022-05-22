<?php

namespace App\Builder;

use App\Entity\Hotel;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Menu\FactoryInterface;
use Knp\Menu\ItemInterface;
use Symfony\Component\Security\Core\Security;

// use symfony\Component\Security\Core\Security;
class MenuBuilder
{

    private FactoryInterface $factory;
    private EntityManagerInterface $entityManager;
    private Security $security;

    public function __construct(FactoryInterface $factory, EntityManagerInterface $entityManager , Security $security)
    {
        $this->factory = $factory;
        $this->entityManager = $entityManager;
        $this->security = $security;
    }

    public function mainMenu(array $options): ItemInterface
    {
        $menu = $this->factory->createItem('root');

        if (!$this->security->isGranted("IS_AUTHENTICATED_FULLY")) {
            $menu->addChild('Login', ['route' => 'app_login']); 
            $menu->addChild('Register', ['route' => 'app_register']);
        }else{
            $menu->addChild('Log out', ['route' => 'app_logout']); 
        }

        $menu->addChild('Home', ['route' => 'home_index']); 

        // create another menu item
        $menu->addChild('About', ['route' => 'about_index']);

        // create another menu item
        $menu->addChild('Support', ['route' => 'app_contact_us']); 

        $hotelsMenu = $menu->addChild('Hotels', ['route' => 'app_hotel_index']);

        /** @var hotel[] $hotels */
        $hotels = $this->entityManager->getRepository(Hotel::class)->findAll();

        foreach ($hotels as $hotel) {
            $hotelsMenu->addChild($hotel->getName(), [
                'route' => 'app_hotel_show',
                'routeParameters' => ['id' => $hotel->getId()]
            ]);
        }

        return $menu;
    }

}