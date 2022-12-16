<?php

namespace App\Controller;

use App\Repository\EvenementRepository;
use App\Repository\PartenaireRepository;
use App\Repository\PostRepository;
use App\Repository\RubriqueRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class SitemapController extends AbstractController
{
    public function __construct(
        private EvenementRepository  $eventRepository,
        private PartenaireRepository $partenaireRepository,
        private RubriqueRepository   $rubriqueRepository,
        private PostRepository       $postRepository,
    )
    {
    }

    public function makeSitemap(): array
    {
        // find published blog posts from db
        $events = $this->eventRepository->findAll();
        $posts = $this->postRepository->findAll();
        $partenaires = $this->partenaireRepository->findAll();
        $rubriques = $this->rubriqueRepository->findAll();

        $urls = [];
        $urls[] = ['loc' => $this->generateUrl('app_home', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'partie' => 'Principale',
            'titre' => 'Accueil'];
        $urls[] = ['loc' => $this->generateUrl('app_carte', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'partie' => 'Principale',
            'titre' => 'Carte'];
        $urls[] = ['loc' => $this->generateUrl('app_agenda', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'partie' => 'Principale',
            'titre' => 'Agenda'];
        $urls[] = ['loc' => $this->generateUrl('app_blog', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'partie' => 'Principale',
            'titre' => 'Souvenirs'];
        $urls[] = ['loc' => $this->generateUrl('app_musique', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'partie' => 'Principale',
            'titre' => 'Musique'];
        $urls[] = ['loc' => $this->generateUrl('app_animation', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'partie' => 'Principale',
            'titre' => 'Animations'];
        $urls[] = ['loc' => $this->generateUrl('app_bienetre', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'partie' => 'Principale',
            'titre' => 'Bien être'];
        $urls[] = ['loc' => $this->generateUrl('app_relaxation', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'partie' => 'Principale',
            'titre' => 'Relaxation'];
        $urls[] = ['loc' => $this->generateUrl('app_presse', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'partie' => 'Principale',
            'titre' => 'Articles de presse'];
        $urls[] = ['loc' => $this->generateUrl('app_partenaires', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'partie' => 'Principale',
            'titre' => 'Partenaires'];
        $urls[] = ['loc' => $this->generateUrl('app_livre_add', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'partie' => 'Formulaire',
            'titre' => 'Ajouter un commentaire'];
        $urls[] = ['loc' => $this->generateUrl('app_contact', [], UrlGeneratorInterface::ABSOLUTE_URL),
            'partie' => 'Formulaire',
            'titre' => 'Me contacter'];

        foreach ($posts as $post) {
            $urls[] = [
                'loc' => $this->generateUrl(
                    'app_souvenirs',
                    ['titre' => $post->getTitre()],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
                'partie' => 'Post',
                'titre' => $post->getTitre(),
            ];
        }
        foreach ($partenaires as $partenaire) {
            $urls[] = [
                'loc' => $this->generateUrl(
                    'app_partenaires',
                    ['slug' => $partenaire->getSlug()],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
                'partie' => 'Partenaire',
                'titre' => $partenaire->getEntreprise(),
            ];
        }
        foreach ($events as $event) {
            $urls[] = [
                'loc' => $this->generateUrl(
                    'app_agenda',
                    ['slug' => $event->getSlug()],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
                'partie' => 'Event',
                'titre' => $event->getTitre(),
            ];
        }
        foreach ($rubriques as $rubrique) {
            $urls[] = [
                'loc' => $this->generateUrl(
                    'app_livre_index',
                    ['rubrique' => $rubrique->getNom()],
                    UrlGeneratorInterface::ABSOLUTE_URL
                ),
                'partie' => 'Livre',
                'titre' => $rubrique->getNom(),
            ];
        }

        return $urls;
    }


    #[Route('/sitemap.xml', name: 'app_sitemap_xml')]
    public function sitemap_xml(): Response
    {
        $urls = $this->makeSitemap();

        $response = new Response(
            $this->renderView('./sitemap/sitemap_xml.html.twig', ['urls' => $urls]),
            200
        );
        $response->headers->set('Content-Type', 'text/xml');
        return $response;
    }

    #[Route('/sitemap', name: 'app_sitemap')]
    public function sitemap(): Response
    {
        $urls = $this->makeSitemap();

        return $this->render('sitemap/sitemap.html.twig', compact('urls'));
    }
}