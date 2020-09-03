<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Aliment;
class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /* on instancie un nouveau objet de type aliment qui sera  ensuite remplie par des données que j'ai spécifié */ 
        $a1 = new Aliment();
        $a1->setNom("Carotte")
            ->setCalorie(36)
            ->setPrix(1.80)
            ->setImage("carrote.jpg")
            ->setProteine(0.77)
            ->setGlucide(6.45)
            ->setLipide(0.26)
            ->setUploadedAt(new \DateTime('now'));

        /* une fois que nous avons parametrer les parametres de l'aliment on doit preparer son ajout dans 
        la base de donnée*/     
        $manager->persist($a1);

        $a2 = new Aliment();
        $a2->setNom("Patate")
            ->setPrix(1.50)
            ->setCalorie(80)
            ->setImage("pommedeterre.jpg")
            ->setProteine(1.80)
            ->setGlucide(16.7)
            ->setLipide(0.34)
            ->setUploadedAt(new \DateTime('now'));
        $manager->persist($a2);

        $a3 = new Aliment();
        $a3->setNom("Tomate")
            ->setPrix(2.30)
            ->setCalorie(18)
            ->setImage("tomate.jpg")
            ->setProteine(0.86)
            ->setGlucide(2.26)
            ->setLipide(0.24)
            ->setUploadedAt(new \DateTime('now'));
        $manager->persist($a3);

        $a4 = new Aliment();
        $a4->setNom("Pomme")
            ->setPrix(2.35)
            ->setCalorie(52)
            ->setImage("pomme.jpg")
            ->setProteine(0.25)
            ->setGlucide(11.6)
            ->setLipide(0.25)
            ->setUploadedAt(new \DateTime('now'));
        $manager->persist($a4);

        $manager->flush();
    }
}
