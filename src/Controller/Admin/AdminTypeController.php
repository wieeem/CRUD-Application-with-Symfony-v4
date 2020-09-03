<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TypeRepository;
use App\Entity\Type;
use App\Form\TypeType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\ORM\EntityManagerInterface;
/* De meme pour ce controller il va refaire les memes operations effectué dans le controller AdminAlimentController
mais maintenant sur l'entité Type */

class AdminTypeController extends AbstractController
{
    /**
     * @Route("/admin/type", name="admintype")
     */
    public function index(TypeRepository $repository)
    {
        $type=$repository->findAll();
        return $this->render('admin/admin_type/index.html.twig', [
            'types' => $type,
        ]);
    }

    
     /**
     * @Route("/admin/type/creation", name="admintype_creation")
     * @Route("/admin/type/{id}", name="admintype_modification",methods="GET|POST")
     */
    public function AjoutEtModif(Type $type = null,Request $request,EntityManagerInterface  $manager)
    {
        if(!$type){
            $type = new Type();
        }
        $form = $this->createForm(TypeType::class,$type);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $modif = $type->getId() !== null ;
            $manager->persist($type);
            $manager->flush();
            $this->addFlash('success',($modif) ?'La modification est faite': "L'ajout est fait");
            return $this->redirectToRoute("admintype");
        }
        return $this->render('admin/admin_type/modification.html.twig',[
        'type'=> $type,
        'form'=>$form->createView(),
         'isModification' => $type->getId() == !null 
        ]
        );
    }


    
     /**
     * @Route("/admin/type/{id}", name="admintype_suppression", methods="delete")
     */
    public function suppression(Type $type = null,Request $request,EntityManagerInterface  $objectmanager)
    {
        if($this->isCsrfTokenValid('SUP'. $type->getId(),$request->get('_token'))){
             $objectmanager->remove($type);
        $objectmanager->flush(); 
        $this->addFlash('success','La suppression est faite');
        return $this->redirectToRoute('admintype');
        }
       
    }
}
