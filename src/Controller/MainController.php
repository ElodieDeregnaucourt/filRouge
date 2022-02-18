<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function accueil(): Response
    {
        return $this->render('main/accueil.html.twig', [
            
        ]);
    }

    #[Route('/boutique', name: 'boutique')]
    public function boutique(ProductRepository $pR): Response
    {
        $products = $pR->findAll();
        return $this->render('main/boutique.html.twig', [
            "produits" => $products,
        ]);
    }

    #[Route('/contacts', name: 'contacts')]
    public function contacts(): Response
    {
        return $this->render('main/contact.html.twig', [
            
        ]);
    }

    #[Route('/vente_privee', name: 'boutique_privee')]
    public function boutiquePrivee(ProductRepository $pR, CategoryRepository $cR): Response
    {
        // récuperation de l'id de la category VIP
        $category = $cR->findBy(['title' => 'VIP']);
        // ................
        $catId = 6;
        $products = $pR->findCategory($catId);
        return $this->render('main/boutique.html.twig', [
            "produits" => $products,
        ]);
    }

}
