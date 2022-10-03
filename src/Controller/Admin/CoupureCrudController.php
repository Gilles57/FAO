<?php

namespace App\Controller\Admin;

use App\Entity\Coupure;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class CoupureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coupure::class;
    }
// TODO gestion des coupures de presse

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
