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
<<<<<<< HEAD
        $units = $entityManager->getRepository(Unit::class)->findAll();



=======
        // Récupérer toutes les unités depuis l'entité EntityManager
        $units = $entityManager->getRepository(Unit::class)->findAll();

        // Rendre la vue 'admin/unit/index.html.twig' avec les données récupérées
>>>>>>> 91f9245964b27b13bebb8c597a8b31c82c6357ea
        return $this->render('admin/unit/index.html.twig', [
            'units' => $units
        ]);
    }
<<<<<<< HEAD
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
=======

    #[Route('/create', name: 'create')]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        // Créer une nouvelle unité
        $unit = new Unit();

        // Créer un formulaire basé sur UnitType et associer l'unité avec le formulaire
        $form = $this->createForm(UnitType::class, $unit);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $formData = $form->getData();

            // Définir les données pour l'entité Unit
>>>>>>> 91f9245964b27b13bebb8c597a8b31c82c6357ea
            $unit->setNomModule($formData->getNomModule());
            $unit->setTypeModule($formData->getTypeModule());
            $unit->setDescription($formData->getDescription());
            $unit->setEtatModule($formData->getEtatModule());
            $unit->setDonneesMesurees($formData->getDonneesMesurees());

<<<<<<< HEAD
            // Set created and updated at timestamps
            $unit->setCreatedAt(new \DateTimeImmutable());
            $unit->setUpdatededAt(new \DateTimeImmutable());

            // Persist and flush
            $entityManager->persist($unit);
            $entityManager->flush();

            $this->addFlash('success', 'La unité a bien été créée');

            return $this->redirectToRoute('admin.unit.index');
        }

=======
            // Définir les horodatages createdAt et updatedAt
            $unit->setCreatedAt(new \DateTimeImmutable());
            $unit->setUpdatededAt(new \DateTimeImmutable());

            // Persister et vider
            $entityManager->persist($unit);
            $entityManager->flush();

            // Ajouter un message flash de succès
            $this->addFlash('success', 'La unité a bien été créée');

            // Rediriger vers la page d'index
            return $this->redirectToRoute('admin.unit.index');
        }

        // Rendre la vue 'admin/unit/create.html.twig' avec le formulaire
>>>>>>> 91f9245964b27b13bebb8c597a8b31c82c6357ea
        return $this->render('admin/unit/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    #[Route('/{id}', name: 'edit', methods: ['GET', 'POST'], requirements: ['id' => Requirement::DIGITS])]
    public function edit(Request $request, EntityManagerInterface $entityManager, Unit $unit): Response
    {
<<<<<<< HEAD
        $form = $this->createForm(UnitType::class, $unit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $unit->setUpdatededAt(new \DateTimeImmutable());
            $entityManager->flush();
            $this->addFlash('success', 'La unité a bien été mise à jour');

            return $this->redirectToRoute('admin.unit.index');
        }

=======
        // Créer un formulaire basé sur UnitType et associer l'unité avec le formulaire
        $form = $this->createForm(UnitType::class, $unit);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);

        // Vérifier si le formulaire est soumis et valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Mettre à jour l'horodatage updatedAt
            $unit->setUpdatededAt(new \DateTimeImmutable());

            // Vider les modifications dans la base de données
            $entityManager->flush();

            // Ajouter un message flash de succès
            $this->addFlash('success', 'La unité a bien été mise à jour');

            // Rediriger vers la page d'index
            return $this->redirectToRoute('admin.unit.index');
        }

        // Rendre la vue 'admin/unit/edit.html.twig' avec le formulaire et l'unité
>>>>>>> 91f9245964b27b13bebb8c597a8b31c82c6357ea
        return $this->render('admin/unit/edit.html.twig', [
            'form' => $form->createView(),
            'unit' => $unit
        ]);
    }
<<<<<<< HEAD
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


=======

    #[Route('/delete/{id}', name: 'delete', methods: ['DELETE'], requirements: ['id' => Requirement::DIGITS])]
    public function delete(EntityManagerInterface $entityManager, Unit $unit): Response
    {
        // Supprimer l'unité de la base de données
        $entityManager->remove($unit);
        $entityManager->flush();

        // Ajouter un message flash de succès
        $this->addFlash('success', 'La unité a bien été supprimée');

        // Rediriger vers la page d'index
        return $this->redirectToRoute('admin.unit.index');
    }
}
>>>>>>> 91f9245964b27b13bebb8c597a8b31c82c6357ea
