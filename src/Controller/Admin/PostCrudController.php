<?php

namespace App\Controller\Admin;

use App\Entity\Post;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Vich\UploaderBundle\Form\Type\VichImageType;

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
            SlugField::new('slug')->setTargetFieldName('titre')->onlyOnIndex(),
            DateTimeField::new('publishedAt', 'Date de publication')
                ->setFormat('d/M/Y'),
            TextareaField::new('contenu', "Texte de l'article")
                ->setFormType(CKEditorType::class)
                ->addFormTheme('@FOSCKEditor/Form/ckeditor_widget.html.twig'),
            TextField::new('mediaFile', 'Nom du media')
                ->hideOnIndex(),

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
