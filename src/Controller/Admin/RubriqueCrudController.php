<?php

namespace App\Controller\Admin;

use App\Entity\Rubrique;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class RubriqueCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Rubrique::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('nom', "Nom de la rubrique"),
            ColorField::new('color', "Couleur de la rubrique"),
        ];
    }
}
