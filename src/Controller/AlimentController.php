<?php

namespace App\Controller;

use App\Repository\AlimentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AlimentController extends AbstractController
{
    /**
     * @Route("/", name="aliments")
     */
    public function index(AlimentRepository $repository): Response
    {
        $aliments = $repository->findAll();

        return $this->render('aliment/aliments.html.twig', [
            'controller_name' => 'AlimentController',
            'aliments' => $aliments,
            'isCalorie' => false,
            'isGlucide' => false
        ]);
    }

    /**
     * @Route("/aliments/calorie/{calorie}", name="alimentParCalorie")
     */
    public function alimentMoinsCaloriques(AlimentRepository $repository, $calorie): Response
    {
        $aliments = $repository->getAlimentParPropriete('calorie','<', $calorie);
        return $this->render('aliment/aliments.html.twig', [
            'controller_name' => 'AlimentController',
            'aliments' => $aliments,
            'isCalorie' => true,
            'isGlucide' => false
        ]);
    }

    /**
     * @Route("/aliments/glucide/{glucide}", name="alimentParGlucide")
     */
    public function alimentMoinsGlucides(AlimentRepository $repository, $glucide): Response
    {
        $aliments = $repository->getAlimentParPropriete('glucide','<', $glucide);
        return $this->render('aliment/aliments.html.twig', [
            'controller_name' => 'AlimentController',
            'aliments' => $aliments,
            'isCalorie' => false,
            'isGlucide' => true
        ]);
    }
}
