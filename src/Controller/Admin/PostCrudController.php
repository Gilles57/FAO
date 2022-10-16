<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use App\Form\MediasType;
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
            TextField::new('mediaFile', 'Nom du media')
                ->onlyOnDetail(),

            TextField::new('mediaFile', 'Nom du fichier')
                ->setFormType(VichImageType::class)
                ->setFormTypeOption('allow_delete', false)
                ->hideOnIndex(),
            ImageField::new('mediaName', 'MEDIA PRINCIPALE')
                ->setBasePath('/uploads/medias')
                ->setUploadDir('/public/uploads/medias')
                ->onlyOnIndex(),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined();
    }

}
