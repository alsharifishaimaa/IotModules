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
        $form = $this->createForm(ContacteType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            //dd($data);
            $address = $data['email'];
            $content = $data['message'];
            $email = (new Email())
                ->from($address)
                ->to('admin@admin.com')
                ->subject('Demande de contact')
                ->text($content);
            $mailer->send($email);
    
            $this->addFlash('success', 'Votre message a été envoyé avec succès.');
            return $this->redirectToRoute('app_contacte');
        }
        return $this->render('contacte/index.html.twig', [
            'controller_name' => 'ContacteController',
            'form' => $form->createView(),
        ]);
    }
}
