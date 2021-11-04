<?php

namespace App\Controller\Admin;

use App\Entity\Type;
use App\Form\TypeType;
use App\Repository\TypeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class adminTypeController extends AbstractController
{
    /**
     * @Route("/admin/types", name="admin_types")
     */
    public function index(TypeRepository $repository): Response
    {
        $types = $repository->findAll();

        return $this->render('admin/admin_type/adminTypes.html.twig', [
            'controller_name' => 'adminTypeController',
            'types' => $types
        ]);
    }

    /**
     * @Route("/admin/types/{id}", name="admin_types_suppression", methods={"DELETE"})
     */
    public function suppression(Type $type, Request $request, EntityManagerInterface $entityManager): Response
    {
        if($this->isCsrfTokenValid("SUP". $type->getId(),$request->get('_token'))){
            $entityManager->remove($type);
            $entityManager->flush();
            $this->addFlash('success', "La suppression à été effectuée");
            return $this->redirectToRoute("admin_types");
        }
    }

    /**
     * @Route("/admin/types/creation", name="admin_types_creation")
     * @Route("/admin/types/{id}", name="admin_types_modification", methods={"GET","POST"})
     */
    public function ajoutEtModification(Type $type = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if(!$type) {
            $type = new Type();
        }

        $form = $this->createForm(TypeType::class, $type);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $modif = $type->getId() !== null;
            $entityManager->persist($type);
            $entityManager->flush();
            $this->addFlash('success', ($modif) ? "La modification a été effectuée" : "L'ajout a été effectuée");
            return $this->redirectToRoute('admin_types');
        }

        return $this->render('admin/admin_type/ajoutEtModificationType.html.twig', [
            'type' => $type,
            'form' => $form->createView(),
            'modification' => $type->getId() !== null
        ]);
    }
}
