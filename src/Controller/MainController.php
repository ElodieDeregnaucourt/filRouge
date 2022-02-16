<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'accueil')]
    public function accueil(): Response
    {
        return $this->render('main/accueil.html.twig', [
            
        ]);
    }

    #[Route('/boutique', name: 'boutique')]
    public function boutique(): Response
    {
        return $this->render('main/boutique.html.twig', [
            
        ]);
    }

    #[Route('/contacts', name: 'contacts')]
    public function contacts(): Response
    {
        return $this->render('admin/contacts.html.twig', [
            
        ]);
    }

    #[Route('/vente_privee', name: 'boutique_privee')]
    public function boutiquePrivee(): Response
    {
        return $this->render('main/boutiquePrivee.html.twig', [
            
        ]);
    }

}
