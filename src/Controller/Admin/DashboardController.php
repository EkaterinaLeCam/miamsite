<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Commentaire;
use App\Entity\Image;
use App\Entity\Ingredient;
use App\Entity\NotePlat;
use App\Entity\Recette;
use App\Entity\RecetteIngredient;
use App\Entity\SousCategorie;
use App\Entity\TableDeReponses;
use App\Entity\Utilisateur;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin', methods: ['GET', 'POST'])]
    public function index(): Response
    {
        return $this->render ('admin/index.html.twig');

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Miamsite');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Categorie', 'fas fa-list', Categorie::class);
        yield MenuItem::linkToCrud('SousCategorie', 'fas fa-list', SousCategorie::class);
        yield MenuItem::linkToCrud('Image', 'fas fa-image', Image::class);
        yield MenuItem::linkToCrud('Ingredients', 'fas fa-list', Ingredient::class);
        yield MenuItem::linkToCrud('RecetteIngredient', 'fas fa-list', RecetteIngredient::class);
        yield MenuItem::linkToCrud('Recette', 'fas fa-list', Recette::class);
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', Utilisateur::class);
        yield MenuItem::linkToCrud('Commentaire', 'fas fa-comments', Commentaire::class);
        yield MenuItem::linkToCrud('NoterPlat', 'fas fa-star', NotePlat::class);
        yield MenuItem::linkToCrud('TableDeReponses', 'fas fa-pencil', TableDeReponses::class);
    }
}
