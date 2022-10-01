<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use App\Repository\RubriqueRepository;
use App\Repository\VilleRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Bundle\MakerBundle\Doctrine\RelationManyToOne;

class EvenementCrudController extends AbstractCrudController
{
    public function __construct(private VilleRepository $villeRepository)
    {
    }

    public static function getEntityFqcn(): string
    {
        return Evenement::class;
    }


    public function configureFields(string $pageName): iterable
    {


        return [
            IdField::new('id')->onlyOnIndex(),
            AssociationField::new('ville', 'Nom de la ville')
                ->autocomplete(),
            AssociationField::new('rubrique'),
            BooleanField::new('preferred', 'Ville actuelle'),
            DateTimeField::new('beginAt', "Date d'arrivée")->setFormat('d/M/Y'),
            DateTimeField::new('endAt', 'Date de départ')->setFormat('d/M/Y'),
            TextEditorField::new('description'),
        ];
    }
}
