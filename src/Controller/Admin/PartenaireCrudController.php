<?php

namespace App\Controller\Admin;

use App\Entity\Partenaire;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class PartenaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Partenaire::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('entreprise'),
            TextField::new('nom'),
            SlugField::new('slug')->setTargetFieldName('titre')->onlyOnIndex(),
            TextField::new('adresse'),
            TextField::new('codepostal'),
            TextField::new('ville'),
            TextField::new('tel'),
            TextField::new('site'),
            TextEditorField::new('description'),
            TextField::new('logoFile', "Logo de l'entreprise")
                ->setFormType(VichImageType::class)
                ->hideOnIndex()
                ->setRequired(true)
                ->setFormTypeOption('allow_delete', false)
            ,
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->showEntityActionsInlined();
    }

}
