<?php

namespace App\Controller;

use App\Classe\Search;
use App\Entity\Product;
use App\Form\SearchType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        
    }
    
    

    /**
     * @Route("/nos-produits", name="products")
     */
    public function index(Request $request): Response
    {

        //On recuper repository qui nous permet d'accés les données
        //$products = $this->entityManager->getRepository(Product::class)->findAll();

        //on creer new objet searche
        $search = new Search;
        //appele $form avec la method createForm 
        $form = $this->createForm(SearchType::class, $search);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

        $products = $this->entityManager->getRepository(Product::class)->findWithSearch($search);     
        } else {
            $products = $this->entityManager->getRepository(Product::class)->findAll();
        }

        return $this->render('product/index.html.twig', [

            'products' => $products,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/produit/{slug}", name="product")
     */
    public function show($slug): Response
    {
        //chercher les produit par la propriete slug depuis doctrine
        $product = $this->entityManager->getRepository(Product::class)->findOneBy(['slug' => $slug]);
        //dd($product);
        //si le product est null on rajoute une route vers produits
        if (!$product) {
            return $this->redirectToRoute('products');
            
        } else{
      //
        return $this->render('product/show.html.twig', [

            'product' => $product
        ]);
        }
    }
}
