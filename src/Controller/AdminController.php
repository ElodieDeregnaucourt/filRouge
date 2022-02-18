<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Entity\Product;
use App\Entity\Category;
use App\Form\ContactType;
use App\Form\ProductType;
use App\Form\CategoryType;
use App\Repository\ContactRepository;
use App\Repository\ProductRepository;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /* ...........PRODUIT.........*/

    /* AFFICHER */
    #[Route('/admin/produits/afficher', name: 'produits_afficher')]

    public function display_products(ProductRepository $pR): Response 
    {
        $products = $pR->findAll();

        return $this->render("admin/produits.html.twig", 
        ["produits" => $products,

    ]);
    }
    /* AJOUTER */
    #[Route('/admin/produits/ajouter', name: 'produit_ajouter')]

    public function ajouter_produit(Request $request, EntityManagerInterface $manager)
    {
        
        $products = new Product;

        $form = $this->createForm(ProductType::class, $products);
        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        { 
            //dd($request);
            $manager->persist($products); // définir l'objet a envoyer
            $manager->flush(); // envoyer
            $this ->addFlash ('success', "Votre produit " . $products->getTitle() . " a bien été ajoutée");
            return $this->redirectToRoute("produits_afficher");
        }

        return $this->render('admin/ajouterProduit.html.twig', [
            'formProduct' => $form -> createView(),

        ]);
    }
    /* MODIFIER */
    #[Route('/admin/produits/modifier/{id}', name: 'produit_modifier')]

    public function modifier_produit(Product $products , Request $request, EntityManagerInterface $manager)
    {
 
        $form = $this->createForm(ProductType::class, $products);
        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        { 
            //dd($request);
            $manager->persist($products); // définir l'objet a envoyer
            $manager->flush(); // envoyer
            $this ->addFlash ('success', "Votre produit " . $products->getTitle() . " a bien été modifiée");
            return $this->redirectToRoute("produits_afficher");
        }

        return $this->render('admin/modifierProduit.html.twig', [
            'formProduct' => $form -> createView(),

        ]);
    }
    /* SUPPRIMER */
    #[Route("/gestion_produit/supprimer/{id}", name: "produit_supprimer")]
    
    public function supprimer_produit(Product $products , EntityManagerInterface $manager): Response
    {
            $titleProduct = $products->getTitle();
            
            $manager->remove($products); 
            $manager->flush();
            $this ->addFlash ('success', "Votre fiche produit " . $titleProduct . " a bien été supprimée");
            return $this->redirectToRoute("produits_afficher");

    }

    /*.........CONTACT...........*/

    /* AFFICHER */
    #[Route('/admin/contacts/afficher', name: 'contacts_afficher')]

    public function display_contacts(ContactRepository $cR): Response 
    {
        $contacts = $cR->findAll();

        return $this->render("admin/contacts.html.twig", 
        ["contacts" => $contacts,

    ]);
    }
    /* AJOUTER */
    #[Route('/admin/contacts/ajouter', name: 'contact_ajouter')]

    public function ajouter_contact(Request $request, EntityManagerInterface $manager)
    {
        
        $contacts = new Contact;

        $form = $this->createForm(ContactType::class,  $contacts);
        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        { 
            //dd($request);
            $manager->persist( $contacts); // définir l'objet a envoyer 
            $manager->flush(); // envoyer
            $this ->addFlash ('success', "Votre contact " .  $contacts->getFirstName() . " a bien été ajoutée");
            return $this->redirectToRoute("contacts_afficher");
        }

        return $this->render('admin/ajouterContact.html.twig', [
            'formContact' => $form -> createView(),

        ]);
    }
    /* MODIFIER */
    #[Route('/admin/contacts/modifier/{id}', name: 'contacts_modifier')]

    public function modifier_contact( Contact $contacts , Request $request, EntityManagerInterface $manager)
    {
 
        $form = $this->createForm(ContactType::class, $contacts);
        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        { 
            //dd($request);
            $manager->persist($contacts); // définir l'objet a envoyer
            $manager->flush(); // envoyer
            $this ->addFlash ('success', "Votre contact " . $contacts->getFirstName() . " a bien été modifiée");
            return $this->redirectToRoute("contacts_afficher");
        }

        return $this->render('admin/modifierContact.html.twig', [
            'formCont' => $form -> createView(),

        ]);
    }
    /* SUPPRIMER */
    #[Route("/gestion_contact/supprimer/{id}", name: "contact_supprimer")]
    
    public function supprimer_contact (Contact $contacts , EntityManagerInterface $manager): Response
    {
            $FirstNameContact = $contacts->getFirstName();
            
            $manager->remove($contacts); 
            $manager->flush();
            $this ->addFlash ('success', "Votre fiche contact " . $FirstNameContact . " a bien été supprimée");
            return $this->redirectToRoute("contacts_afficher");

    }

    /*........CATEGORIES........*/

    /* AFFICHER */
    #[Route('/admin/categories/afficher', name: 'categories_afficher')]

    public function display_categories(CategoryRepository $catR): Response 
    {
        $categories = $catR->findAll();

        return $this->render("admin/categories.html.twig", 
        ["categories" => $categories,

    ]);
    }
     /* AJOUTER */
     #[Route('/admin/categories/ajouter', name: 'categories_ajouter')]

     public function ajouter_categorie(Request $request, EntityManagerInterface $manager)
     {
         
        $categories = new Category;
 
         $form = $this->createForm(CategoryType::class,  $categories);
         $form ->handleRequest($request);
 
         if($form->isSubmitted() && $form->isValid()) 
         { 
             //dd($request);
             $manager->persist( $categories); // définir l'objet a envoyer 
             $manager->flush(); // envoyer
             $this ->addFlash ('success', "Votre categorie " .  $categories->getTitle() . " a bien été ajoutée");
             return $this->redirectToRoute("categories_afficher");
         }
 
         return $this->render('admin/ajouterCategorie.html.twig', [
             'formCategory' => $form -> createView(),
 
         ]);
     }
      /* MODIFIER */
    #[Route('/admin/categories/modifier/{id}', name: 'categories_modifier')]

    public function modifier_categories( Category $categories , Request $request, EntityManagerInterface $manager)
    {
 
        $form = $this->createForm(CategoryType::class, $categories);
        $form ->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) 
        { 
            //dd($request);
            $manager->persist($categories); // définir l'objet a envoyer
            $manager->flush(); // envoyer
            $this ->addFlash ('success', "Votre categorie " . $categories->getTitle() . " a bien été modifiée");
            return $this->redirectToRoute("categories_afficher");
        }

        return $this->render('admin/modifierCategorie.html.twig', [
            'formCat' => $form -> createView(),

        ]);
    }
    /* SUPPRIMER */
    #[Route("/gestion_categories/supprimer/{id}", name: "categories_supprimer")]
    
    public function supprimer_categorie (Category $categories , EntityManagerInterface $manager): Response
    {
            $TitleCategorie = $categories->getTitle();
            
            $manager->remove($categories); 
            $manager->flush();
            $this ->addFlash ('success', "Votre fiche categorie " . $TitleCategorie . " a bien été supprimée");
            return $this->redirectToRoute("categories_afficher");

    }



}



