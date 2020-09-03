<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AlimentRepository;
use App\Entity\Aliment;
use App\Form\AlimentType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
class AdminAlimentController extends AbstractController
{
    /* Lorsque cette route est appelé c'est la fonction index du controller qui sera exécuté
    qui va chercher tout les donnée de lentité Aliment a partir du AlimentRepository 
    ensuite elle va renvoyé le resultat vers la vue sous la forme d'un tableau associative clé=>valeur */


    /**
     * @Route("/admin/aliment", name="adminaliment")
     */
    public function index(AlimentRepository $repository)
    {
        $aliments=$repository->findAll();
        return $this->render('admin/admin_aliment/admin.html.twig',['aliments'=> $aliments]
        );
    }







        /* Cette fonction AjoutetModif peut etre appelé par deux routes differents 
        car elle peut servir pour creation d'un nv aliment ou aussi de modifer l'aliment.
        Pour la modification il faut envoyé dans les parametres de la route l'id de l'aliment 
        qui va etre modifié */


     /**
     * @Route("/admin/aliment/creation", name="adminaliment_creation")
     * @Route("/admin/aliment/{id}", name="adminaliment_modification",methods="GET|POST")
     */
    public function AjoutEtModif(Aliment $aliment = null,Request $request,EntityManagerInterface  $manager)
    {
        if(!$aliment){
            $aliment = new Aliment();
        }
        /* on fait appel au form crée AlimentType */
        $form = $this->createForm(AlimentType::class,$aliment);
        $form->handleRequest($request);

        /* Si le formulaire est bien saisi alors en persist les données dans notre base de données */
        if($form->isSubmitted() && $form->isValid()){
            $modif = $aliment->getId() !== null ;
            $manager->persist($aliment);
            /* avec la fonction flush on stocke en backend le message de succés de l'action effectué */
            $manager->flush();
            /* une fois que le resultats du flash est affiché dans la template il sera supprimer de 
            la session */
            $this->addFlash('success',($modif) ?'La modification est faite': "L'ajout est fait");
            return $this->redirectToRoute("adminaliment");
        }

        /* ce controller va envoyé vers la vue modification.html.twig comme resultat la valeur
         du parametre aliment, le formulaire 
        et une variabe boolenne isModification qui indiquer si c une operation de modification ou creation */
        
        return $this->render('admin/admin_aliment/modification.html.twig',[
        'aliment'=> $aliment,
        'form'=>$form->createView(),
         'isModification' => $aliment->getId() == !null 
        ]
        );
    }

        /* Cette fonction suppression est appélé par cette route en renvoyant un id dans 
        ses parametre, elle va chercher si l'id existe 
        s'il existe il sera supprimé  */
    
     /**
     * @Route("/admin/aliment/{id}", name="adminaliment_suppression", methods="delete")
     */
    public function suppression(Aliment $aliment = null,Request $request,EntityManagerInterface  $objectmanager)
    {
        /* on utilie csrfTokenValid pour sécurisé la suppression, 
        remarque: le token est déja generer dans l'entité aliment */ 

        if($this->isCsrfTokenValid('SUP'. $aliment->getId(),$request->get('_token'))){
            /* Lancer la fonction remove a partir du manager pour supprimer l'aliment */ 
        $objectmanager->remove($aliment);
        /* le flush va contienir un message qui indique le resultat de l'action effectué  dans le backend*/
        $objectmanager->flush(); 
        /* d'ou on ajoute avec la fonction addFlash message de sucée qui sera aprés recuperer dans la vue
        lors d'une suppression pour indiquer si l'action est faite avec succées ou non .
        On recuperer les message du flash a partir du parametre globale App */ 
        $this->addFlash('success','La suppression est faite');
        /* Le controller va faire une redirection vers la page du route adminaliment */ 
        return $this->redirectToRoute('adminaliment');
        }
       
    }
}
