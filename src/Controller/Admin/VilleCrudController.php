<?php

namespace App\Controller\Admin;

use App\Entity\Ville;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class VilleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ville::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $newCity = Action::new('newCity', 'Nouvelle Ville', 'fa fa-city')
            ->linkToRoute('app_home')
            ->addCssClass('btn btn-info')
        ;

        $actions
            ->add(Crud::PAGE_NEW, $newCity);

        return parent::configureActions($actions); // TODO: Change the autogenerated stub
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
