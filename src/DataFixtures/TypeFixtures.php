<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Type;
use App\Entity\Aliment;
class TypeFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
         $t1 = new Type();
         $t1->setLibelle("Fruits")
            ->setImage("fruits.jpg")
            ->setCreatedAt(new \DateTime('now'));
        $manager->persist($t1);

        $t2 = new Type();
        $t2->setLibelle("Legumes")
           ->setImage("legume.jpg")
           ->setCreatedAt(new \DateTime('now'));
        $manager->persist($t2);
       
       $alimentRepository = $manager->getRepository(Aliment::class);
       $a1 = $alimentRepository->findOneBy(["nom" => "Patate"]);
       $a1->setType($t2);
       $manager->persist($a1);

       $alimentRepository = $manager->getRepository(Aliment::class);
       $a2 = $alimentRepository->findOneBy(["nom" => "Tomate"]);
       $a2->setType($t2);
       $manager->persist($a2);

       $alimentRepository = $manager->getRepository(Aliment::class);
       $a5 = $alimentRepository->findOneBy(["nom" => "Carotte"]);
       $a5->setType($t2);
       $manager->persist($a2);

       $alimentRepository = $manager->getRepository(Aliment::class);
       $a3 = $alimentRepository->findOneBy(["nom" => "Pomme"]);
       $a3->setType($t1);
       $manager->persist($a3);

        $manager->flush();
    }
}
