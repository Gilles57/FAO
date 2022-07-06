<?php

namespace App\Controller\Admin;

use App\Entity\Point;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PointCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Point::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('nom', 'Nom de la ville'),
            NumberField::new('lat', 'Latitude'),
            NumberField::new('lon', 'Longitude'),
            BooleanField::new('preferred', 'Ville actuelle'),
            DateTimeField::new('startAt', "Date d'arrivée")->setFormat('d/M/Y'),
            DateTimeField::new('endAt', 'Date de départ')->setFormat('d/M/Y'),
        ];
    }
}
