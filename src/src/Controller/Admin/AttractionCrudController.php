<?php

namespace App\Controller\Admin;

use App\Entity\Attraction;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class AttractionCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Attraction::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
