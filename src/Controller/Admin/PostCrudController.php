<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\PhotosType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
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
            SlugField::new('slug')->setTargetFieldName('titre'),
            DateTimeField::new('publishedAt', 'Date de publication')
                ->setFormat('d/M/Y'),
            TextEditorField::new('contenu'),
            TextField::new('photoFile', 'Nom de la photo')
                ->onlyOnDetail(),

            TextField::new('photoFile', 'Nom du fichier')
                ->setFormType(VichImageType::class)
                ->setFormTypeOption('allow_delete', false)
                ->hideOnIndex(),
            ImageField::new('photoName', 'PHOTO')
                ->setBasePath('/uploads/photos')
                ->setUploadDir('/public/uploads/photos')
                ->onlyOnIndex(),
//            CollectionField::new('photos', 'PHOTOS')
//            ->setEntryType(PhotosType::class),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined();
    }

}
