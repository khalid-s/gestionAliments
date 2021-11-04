<?php

namespace App\Controller\Admin;

use App\Entity\Aliment;
use App\Form\AlimentType;
use App\Repository\AlimentRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminAlimentController extends AbstractController
{
    /**
     * @Route("/admin/aliments", name="admin_aliments")
     */
    public function index(AlimentRepository $repository): Response
    {
        $aliments = $repository->findAll();

        return $this->render('admin/admin_aliment/adminAliments.html.twig', [
            'controller_name' => 'AdminAlimentController',
            'aliments' => $aliments
        ]);
    }

    /**
     * @Route("/admin/aliments/creation", name="admin_aliments_creation")
     * @Route("/admin/aliments/{id}", name="admin_aliments_modification", methods={"GET","POST"})
     */
    public function ajoutEtModification(Aliment $aliment = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$aliment) {
            $aliment = new Aliment();
        }

        $form = $this->createForm(AlimentType::class, $aliment);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $modif = $aliment->getId() !== null;
            $entityManager->persist($aliment);
            $entityManager->flush();
            $this->addFlash('success', ($modif) ? "La modification a été effectuée" : "L'ajout a été effectuée");
            return $this->redirectToRoute('admin_aliments');
        }

        return $this->render('admin/admin_aliment/ajoutEtModificationAliments.html.twig', [
            'controller_name' => 'AdminAlimentController',
            'aliment' => $aliment,
            'form' => $form->createView(),
            'modification' => $aliment->getId() !== null
        ]);
    }

    /**
     * @Route("/admin/aliments/{id}", name="admin_aliments_suppression", methods={"DELETE"})
     */
    public function suppression(Aliment $aliment, Request $request, EntityManagerInterface $entityManager): Response
    {
        if($this->isCsrfTokenValid("SUP". $aliment->getId(),$request->get('_token'))){
            $entityManager->remove($aliment);
            $entityManager->flush();
            $this->addFlash('success', "La suppression à été effectuée");
            return $this->redirectToRoute("admin_aliments");
        }
    }
}
