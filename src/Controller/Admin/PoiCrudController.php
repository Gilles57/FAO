<?php

namespace App\Controller\Admin;

use App\Entity\Poi;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class PoiCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Poi::class;
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
