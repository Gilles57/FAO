<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use App\Repository\VilleRepository;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

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
            TextField::new('titre', "Titre de l'événement"),
            AssociationField::new('ville', 'Lieu')
                ->autocomplete(),
            AssociationField::new('rubrique'),
            BooleanField::new('preferred', 'Ville actuelle'),
            DateTimeField::new('beginAt', "Arrivée")->setFormat('d/M/Y'),
            DateTimeField::new('endAt', 'Départ')->setFormat('d/M/Y'),
            TextEditorField::new('description'),
//            TextField::new('imageName', "Nom de l'image"),
            TextField::new('imageFile', 'Nom du fichier')
                ->setFormType(VichImageType::class)
                ->hideOnIndex(),
            ImageField::new('imageName', 'IMAGE')
                ->setBasePath('/uploads/medias')
                ->setUploadDir('/public/uploads/medias')
                ->onlyOnIndex(),
        ];
    }

       public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined()
        ;
    }
}
