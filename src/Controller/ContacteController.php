<?php

namespace App\Controller;

use App\Form\ContacteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\MailerInterface;

class ContacteController extends AbstractController
{
    #[Route('/contacte', name: 'app_contacte')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        // Créer le formulaire de contact
        $form = $this->createForm(ContacteType::class);

        // Gérer la soumission du formulaire
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $data = $form->getData();
            
            // Récupérer l'adresse e-mail et le contenu du message
            $address = $data['email'];
            $content = $data['message'];

            // Créer un objet Email avec les informations du message
            $email = (new Email())
                ->from($address)
                ->to('admin@admin.com')
                ->subject('Demande de contact')
                ->text($content);

            // Envoyer l'e-mail
            $mailer->send($email);
            // Ajouter un message flash pour confirmer l'envoi du message
            $this->addFlash('success', 'Votre message a été envoyé avec succès.');

            // Rediriger vers la page de contact
            return $this->redirectToRoute('app_contacte');
        }
        // Rendre la vue du formulaire de contact
        return $this->render('contacte/index.html.twig', [
            'controller_name' => 'ContacteController',
            'form' => $form->createView(),
        ]);
    }
}
