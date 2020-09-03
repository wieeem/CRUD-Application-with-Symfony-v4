<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\AlimentRepository;
class AlimentController extends AbstractController
{
    /* Cette fonction index sera exécuté lorsque la page initiale sera chargé */
    /**
     * @Route("/", name="aliments")
     */
    public function index(AlimentRepository $repository)
    {
        /* en injectant dans les parametres de la fonction index l'objet repository il sera possible d'utiliser
        sa fonction findAll qui nous permet de recuperer toutes les données de l'entité aliment.
        On utilisera aprés cette fonction dans notre template aliments.html.twig pour les afficher */
        $aliments=$repository->findAll();
        
        $indice=true;
        /* Envoyer les resultats vers la vue */
        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $aliments,'isCalorie' => false ,'isGlucide' => false,'indice'=>$indice
        ]);
    }
    /*  La fonction alimentMoinCalorique va etre excécuté lorsque cette route est appelé 
    par l'utilisateur, enfaite cette fonction va extraire */

       /**
     * @Route("/aliments/calorie/{calorie}", name="alimentsParCalorie")
     */
    public function alimentMoinCaloriques(AlimentRepository $repository,$calorie)
    {
        /* le fichier AlimentRepository contient l'implementation de la fonction getAlimentParNBProprite
        donc il suffit pour lui renvoyer en parametre la valeurs des calories,passé dans les 
        parametre de la route */

        $indice=false;
        $aliments=$repository->getAlimentParNbPropriete('calorie','<',$calorie);
        /* le resultat est envoyé vers la vue aliment.html.twig */
        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $aliments, 'isCalorie' => true,'isGlucide' => false,'indice'=>$indice
        ]);
    }


  /*  La fonction alimentMoinGlucide va etre excécuté lorsque cette route est appelé 
    par l'utilisateur, enfaite cette fonction va extraire */

         /**
     * @Route("/aliments/glucide/{glucide}", name="alimentsParGlucides")
     */
    public function alimentMoinGlucide(AlimentRepository $repository,$glucide)
    {
              /* le fichier AlimentRepository contient l'implementation de la fonction getAlimentParNBProprite
        donc il suffit pour lui renvoyer en parametre la valeurs des glucides,passé dans les 
        parametre de la route */
        $indice=false;
        $aliments=$repository->getAlimentParNbPropriete('glucide','<',$glucide);
        return $this->render('aliment/aliments.html.twig', [
            'aliments' => $aliments, 'isCalorie' => false,'isGlucide' => true,'indice'=>$indice
        ]);
    }
}
