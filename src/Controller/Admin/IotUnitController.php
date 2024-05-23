<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Unit;
use App\Form\UnitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Requirement\Requirement;

#[Route("/admin/iot", name: 'admin.unit.')]
class IotUnitController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $units = $entityManager->getRepository(Unit::class)->findAll();



        return $this->render('admin/unit/index.html.twig', [
            'units' => $units
        ]);
    }
    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $unit = new Unit();
        $form = $this->createForm(UnitType::class, $unit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Get data from the form
            $formData = $form->getData();

            // Set the data to the Unit entity
            $unit->setNomModule($formData->getNomModule());
            $unit->setTypeModule($formData->getTypeModule());
            $unit->setDescription($formData->getDescription());
            $unit->setEtatModule($formData->getEtatModule());
            $unit->setDonneesMesurees($formData->getDonneesMesurees());

            // Set created and updated at timestamps
            $unit->setCreatedAt(new \DateTimeImmutable());
            $unit->setUpdatededAt(new \DateTimeImmutable());

            // Persist and flush
            $entityManager->persist($unit);
            $entityManager->flush();

            $this->addFlash('success', 'La unité a bien été créée');

            return $this->redirectToRoute('admin.unit.index');
        }

        return $this->render('admin/unit/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(Request $request, EntityManagerInterface $entityManager, Unit $unit): Response
    {
        $form = $this->createForm(UnitType::class, $unit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $unit->setUpdatededAt(new \DateTimeImmutable());
            $entityManager->flush();
            $this->addFlash('success', 'La unité a bien été mise à jour');

            return $this->redirectToRoute('admin.unit.index');
        }

        return $this->render('admin/unit/edit.html.twig', [
            'form' => $form->createView(),
            'unit' => $unit
        ]);
    }
    #[Route('/{id}', name: 'delete', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    #[Route('/delete/{id}', name: 'delete')]
    public function delete(EntityManagerInterface $entityManager, Unit $unit): Response
    {
        $entityManager->remove($unit);
        $entityManager->flush();
        $this->addFlash('success', 'La unité a bien été supprimée');

        return $this->redirectToRoute('admin.unit.index');
    }
}


