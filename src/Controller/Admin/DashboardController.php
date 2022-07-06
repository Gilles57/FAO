<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use App\Entity\Point;
use App\Entity\Projet;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->redirect($this->adminUrlGenerator->setController(PointCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FAO');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('L\'accueil', 'fa fa-solid fa-home', 'app_home');
        yield MenuItem::linkToRoute('La carte', 'fa fa-solid fa-map', 'app_carte');
        yield MenuItem::section('Administration');
        yield MenuItem::linkToCrud('Les carte sur la carte', 'fa fa-solid fa-map-marker', Point::class);
        yield MenuItem::linkToCrud('Les utilisateurs', 'fa fa-solid fa-user', User::class);

        yield MenuItem::section("Le livre d'or");
        yield MenuItem::linkToCrud('Les commentaires', 'fa fa-solid fa-comments', Commentaire::class);
//        yield MenuItem::linkToCrud('Les catégories', 'fa fa-solid fa-book', CategorieFilm

        yield MenuItem::section('Les projets');
        yield MenuItem::linkToCrud('Les projets', 'fa fa-solid fa-map-signs ', Projet::class);
    }
}
