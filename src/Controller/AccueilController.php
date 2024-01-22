<?php

namespace App\Controller;

use App\Repository\IngredientRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    #[Route('/', name: 'app_accueil')]
    public function index(Request $request,  IngredientRepository $ingredientRepository): Response
    // Récuperer tous les objets Categorie à partir du CategorieRepository
    {
    $ingredients =$ingredientRepository->findAll();

    
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'ingredients'=>$ingredients
        ]);
    }
}
