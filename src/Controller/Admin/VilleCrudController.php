<?php

namespace App\Controller\Admin;

use App\Entity\Ville;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class VilleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Ville::class;
    }

    public function configureActions(Actions $actions): Actions
    {
        $newCity = Action::new('newCity', 'Nouvelle Ville', 'fa fa-city')
            ->linkToRoute('app_ville')
            ->addCssClass('btn btn-info');

        $actions
            ->add(Crud::PAGE_NEW, $newCity)
            ->remove(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER)
            ->remove(Crud::PAGE_NEW, Action::SAVE_AND_RETURN);

        return parent::configureActions($actions);

    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnIndex(),
            TextField::new('nom')->onlyOnIndex(),
            NumberField::new('latitude')->onlyOnIndex(),
            NumberField::new('longitude')->onlyOnIndex(),
        ];
    }

}
