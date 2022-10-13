<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PhotosType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;


class PostCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Post::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('titre', 'Titre du post'),
//            AssociationField::new('rubrique'),
            DateTimeField::new('publishedAt', 'Date de publication')
                ->setFormat('d/M/Y'),
            DateTimeField::new('createdAt', 'Date de création')
                ->setFormat('d/M/Y')
                ->onlyOnIndex(),
            TextEditorField::new('contenu'),
//            TextField::new('imageName', "Nom de l'image"),
            TextField::new('imageFile', 'Nom du fichier')
                ->setFormType(VichImageType::class)
                ->hideOnIndex(),
//            CollectionField::new('photos', 'PHOTOS')
//            ->setEntryType(PhotosType::class),
            ImageField::new('image', 'IMAGE')
                ->setBasePath('/uploads/posts')
                ->setUploadDir('/public/uploads/posts')
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
