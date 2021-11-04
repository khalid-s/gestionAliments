<?php

namespace App\DataFixtures;

use App\Entity\Aliment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {   
        // $a1 = new Aliment;
        // $a1->setNom("Carotte")
        //     ->setPrix(1.80)
        //     ->setCalorie(36)
        //     ->setImage("aliments/carotte.png")
        //     ->setProteine(1.77)
        //     ->setGlucide(6.45) 
        //     ->setLipide(1.26);
        // $manager->persist($a1);
        
        // $a2 = new Aliment;
        // $a2->setNom("Patate")
        //     ->setPrix(1.50)
        //     ->setCalorie(80)
        //     ->setImage("aliments/patate.jpg")
        //     ->setProteine(1.8)
        //     ->setGlucide(16.7) 
        //     ->setLipide(1.36);
        // $manager->persist($a2);

        // $a3 = new Aliment;
        // $a3->setNom("Tomate")
        //     ->setPrix(2.3)
        //     ->setCalorie(18)
        //     ->setImage("aliments/tomate.png")
        //     ->setProteine(4.86)
        //     ->setGlucide(2.26) 
        //     ->setLipide(6.24);
        // $manager->persist($a3);

        // $a4 = new Aliment;
        // $a4->setNom("Pomme")
        //     ->setPrix(2.35)
        //     ->setCalorie(52)
        //     ->setImage("aliments/pomme.png")
        //     ->setProteine(2.25)
        //     ->setGlucide(11.6) 
        //     ->setLipide(2.25);
        // $manager->persist($a4);

        // $manager->flush();
    }
}
