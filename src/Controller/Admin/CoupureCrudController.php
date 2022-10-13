<?php

namespace App\Controller\Admin;

use App\Entity\Coupure;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class CoupureCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Coupure::class;
    }

// TODO gestion des coupures de presse


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('reference', "Titre de l'article"),
            DateTimeField::new('publishedAt', 'Date de publication')
                ->setFormat('d/M/Y'),
            TextField::new('coupureFile', 'Nom du fichier')
                ->setFormType(VichImageType::class)
                ->hideOnIndex(),
//            TextField::new('coupure', "Nom de l'image"),
            ImageField::new('coupure', 'DOCUMENT')
                ->setBasePath('/uploads/coupures')
                ->setUploadDir('/public/uploads/coupures')
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
