<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use App\Entity\Coupure;
use App\Entity\Evenement;
use App\Entity\Photo;
use App\Entity\Partenaire;
use App\Entity\Post;
use App\Entity\Projet;
use App\Entity\Rubrique;
use App\Entity\User;
use App\Entity\Ville;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(private AdminUrlGenerator $adminUrlGenerator)
    {
    }

    #[Route('/admin', name: 'admin')]
        #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->redirect($this->adminUrlGenerator->setController(EvenementCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('FAO Travel');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToRoute('Retour au site', 'fa fa-solid fa-undo', 'app_home');
//        yield MenuItem::linkToRoute('La carte', 'fa fa-solid fa-map', 'app_carte');
        yield MenuItem::section('Administration');
        yield MenuItem::linkToCrud('Les utilisateurs', 'fa fa-solid fa-user', User::class);
        yield MenuItem::linkToCrud('Les partenaires', 'fa fa-solid fa-handshake', Partenaire::class);
        yield MenuItem::linkToCrud('Les villes', 'fa fa-solid fa-city', Ville::class);
        yield MenuItem::linkToCrud('Les rubriques', 'fa fa-solid fa-book', Rubrique::class);

        yield MenuItem::section('Activités');
        yield MenuItem::linkToCrud('Les événements', 'fa fa-solid fa-map-marker', Evenement::class);
        yield MenuItem::linkToCrud('Le blog', 'fa fa-solid fa-blog', Post::class);
        yield MenuItem::linkToCrud('Les images', 'fa fa-solid fa-photo-video', Photo::class);

        yield MenuItem::section("Le livre d'or");
        yield MenuItem::linkToCrud('Les commentaires', 'fa fa-solid fa-comments', Commentaire::class);

        yield MenuItem::section('Les projets');
        yield MenuItem::linkToCrud('Les projets', 'fa fa-solid fa-map-signs ', Projet::class);

        yield MenuItem::section('La presse');
        yield MenuItem::linkToCrud('Les articles', 'fa fa-solid fa-newspaper ', Coupure::class);
    }
}
