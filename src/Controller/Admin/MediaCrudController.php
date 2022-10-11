<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MediaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('mediaName', "Nom de l'image"),
            TextField::new('mediaFile', 'Nom du fichier')
                ->setFormType(VichImageType::class)
                ->onlyWhenCreating(),
            ImageField::new('mediaName', 'IMAGE')
                ->setBasePath('/uploads/medias')
                ->setUploadDir('/public/uploads/medias')
                ->onlyOnIndex(),
        ];
    }
}
