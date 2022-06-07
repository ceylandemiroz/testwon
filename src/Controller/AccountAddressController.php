<?php

namespace App\Controller;

use App\Entity\Address;
use App\Form\AddressType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountAddressController extends AbstractController
{

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        
    }


    /**
     * @Route("/compte/addresses", name="account_address")
     */
    public function index(): Response
    {
        return $this->render('account/address.html.twig');
    }

     /**
     * @Route("/compte/ajouter-une-addresse", name="account_address_add")
     */
    public function add(Request $request): Response
    {
        $address = new Address();
        $form = $this->createForm(AddressType::class, $address);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            //on ajout address avec user connnecté
            $address->setUser($this->getUser());
            //ajout address utilisateur en base de donner
            $this->entityManager->persist($address);
            $this->entityManager->flush();
            //apres ajouter d'address redirigé vers ;
            return$this->redirectToRoute('account_address');

        }

        return $this->render('account/address_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/compte/modifier-une-addresse/{id}", name="account_address_edit")
     */
    public function edit(Request $request, $id): Response
    {
        //on récupere l'addresse par son id  
        $address = $this->entityManager->getRepository( Address::class)->findOneById($id);

        //une condition; si un objet n'existe pas
        // ou objet ne lié pas par un utilisateur connecté
        if(!$address || $address->getUser() != $this->getUser()){
            //on redirige
            return $this->redirectToRoute('account');
        } 
        //formulaire de modification
        $form = $this->createForm(AddressType::class, $address);
        //les modifications de l'address sont prises en compte ici
        $form->handleRequest($request);
        //pour vérifier que notre formulaire ait bien été envoyé
        if ($form->isSubmitted() && $form->isValid())
        {
            //puis on demande à notre EntityManager de valider les changements en base
            $this->entityManager->flush();
            
            return$this->redirectToRoute('account_address');

        }

        return $this->render('account/address_form.html.twig', [
            'form' => $form->createView()
        ]);
    }

     /**
     * @Route("/compte/supprimer-une-addresse/{id}", name="account_address_delete")
     */
    public function delete($id): Response
    {
        //on récupere l'adresse à été crée, via doctrine 
        $address = $this->entityManager->getRepository( Address::class)->findOneById($id);

    //vérifie une adresse qui existe et lié par l'utilisateur
        if($address && $address->getUser() == $this->getUser()){

           //supprimer l'objet avec method remove()
            $this->entityManager->remove($address);
            $this->entityManager->flush();
            
            
        }        
            
            
            return$this->redirectToRoute('account_address');

    }
}
