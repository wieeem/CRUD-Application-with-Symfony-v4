<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Utilisateur;
use App\Form\InscriptionType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
/* Ce controller sert a faire l'inscription , le login et la deconnexion des utilisateurs */
/* il va donc interragir avec l'entité utlisateur et les vue correspondantes */
class AdminSecuController extends AbstractController
{
    /**
     * @Route("/inscription", name="inscription")
     */
    public function index(Request $request,EntityManagerInterface  $manager,UserPasswordEncoderInterface $encoder)
    {
        /* Créer un nouveau utilisateur */
        $utilisateur = new Utilisateur();
        /*créer le formulaire */
        $form = $this->createForm(InscriptionType::class,$utilisateur);
        $form->handleRequest($request);


        /* si le formulaire est bien saisi en encrype le password avec la fonction encodePassword
        pour des raison de sécurité et pour que le mdp de l'utilisateur sera enregistré dans notre 
        base avec ecodage */ 
        if($form->isSubmitted() && $form->isValid()){
            /* avant de soumettre le password il faut l'encoder */
            $passwordCrypte=$encoder->encodePassword($utilisateur,$utilisateur->getPassword());
            $utilisateur->setPassword($passwordCrypte);
            /* persister le resultat pour l'enregistrer dans la base  */
            $manager->persist($utilisateur);
            $manager->flush();
            return $this->redirectToRoute("connexion");
        }
        /*Envoyer le create vue du formulaire vers la vue inscription*/ 
        return $this->render('admin_secu/inscription.html.twig',['form' => $form->createView()]);
    }

    /* La fonction login permet a un utilisateur de s'authentifier avec son nom et son mdp correcte */


     /**
     * @Route("/login", name="connexion")
     */
    public function login(AuthenticationUtils $util){
        return $this->render('admin_secu/login.html.twig',[
            'lastUserName'=>$util->getLastUsername(),
            'error'=> $util->getLastAuthenticationError()
        ]);
    }

    
      /**
     * @Route("/deconnexion", name="deconnexion")
     */
    public function deconnexion(){
       
    }



       /**
     * @Route("/profile", name="profile")
     */
    public function profile(){
        return $this->render('admin_secu/profile.html.twig');
    }

}
