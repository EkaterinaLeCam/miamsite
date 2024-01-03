<?php

namespace App\Controller;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategorieController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    #[Route('/categorie/{id}', name: 'app_categorie', methods:'GET')]
    public function index($id): Response
    {
        //Afficher tout les SousCategories demandée dans le template dédie
        $categorie = $this-> entityManager ->getRepository(Categorie::class)->find($id);

        // Affiche les sousCategories demandée dans le template dédie

        $sousCategories = $categorie->getSousCategorie();

        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
            'sousCategories' => $sousCategories,
            'categorie' => $categorie


        ]);
    }
}
