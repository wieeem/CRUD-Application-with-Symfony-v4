<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TypeRepository;
class TypeController extends AbstractController
{
    /* Quand la route /type est appelé , la fonction index du controlleur sera exécuté, qui va 
    utiliser le repository TypeRepository pour pouvoir recuperer tout le resultat de l'entité Type 
    grace a la fonction findAll 
    Ensuite les resultat seront envoyé vers la vue type.html.twig sous forme d'un tableau associatif */
    
    /**
     * @Route("/types", name="types")
     */
    public function index(TypeRepository $repo)
    {
        $types=$repo->findAll();
        return $this->render('type/types.html.twig', ['Lestypes' => $types]);
    }
}
