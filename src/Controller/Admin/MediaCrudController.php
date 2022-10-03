<?php

namespace App\Controller\Admin;

use App\Entity\Media;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class MediaCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Media::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('mediaName', "nom de l'image"),
            TextField::new('mediaFile')
                ->setFormType(VichImageType::class)
                ->onlyWhenCreating(),
            ImageField::new('mediaFile')
                ->setBasePath('/uploads/medias')
                ->setUploadDir('/public/uploads/medias'),
        ];
    }
}
