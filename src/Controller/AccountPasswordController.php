<?php

namespace App\Controller;

use App\Form\ChangePasswordType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class AccountPasswordController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
        
    }
    
    /**
     * @Route("/compte/modifier-mot-de-passe", name="account_password")
     */
    public function index(Request $request, UserPasswordHasherInterface $userPasswordHasherInterface): Response
    {
        $notification = null;
        //récupéré le user connecté
        $user = $this-> getUser();
        $form = $this->createForm(ChangePasswordType::class, $user);

        //traiter le formulaire
        $form ->handleRequest($request);

        //pour modifier le mot de passe d'abord récuperer l'ancienne mdp
        //j'ai besoin une method qui vas permettre le comparer le mdp actuel et mdp hasher en bdd
        if ($form->isSubmitted() && $form->isValid()) {
            //pour recuperer old pasw en bdd
            $old_pwd = $form->get('old_password')->getData();
            //dd($old_pwd); on récuper old_pwd
            //je vais appele mdp actuel non crypte avec le method
            if ( $userPasswordHasherInterface->isPasswordValid($user, $old_pwd)){
                //newpwd
                $new_pwd = $form->get('new_plainPassword')->getData();
                //dd($new_pwd); onaylandi.

                $password = $userPasswordHasherInterface->hashPassword($user, $new_pwd);

                $user->setPassword($password);

                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                $notification ="votre mot de passe a été mise à jour";


            } 
              else {
                  $notification ="votre mot de passe n'est pas correcte";

              }

        }

        $categories = $this->entityManager->getRepository(Category::class)->findAllCategory();

        return $this->render('account/password.html.twig', [
            'form' => $form->createView(),
            'notification' => $notification,
            'categories' => $categories
        ]);
    }
}
