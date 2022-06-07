<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        
    }

    /**
     * @Route("/compte", name="account")
     */
    public function index(): Response
    {
        $categories = $this->entityManager->getRepository(Category::class)->findAllCategory();
        return $this->render('account/index.html.twig', [
            'categories' => $categories
        ]);
    }
}
