<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Security\EmailVerifier;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    public function __construct(private EmailVerifier $emailVerifier)
    {
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        // Créer une nouvelle instance de l'entité User
        $user = new User();

        // Créer le formulaire d'inscription et le lier à l'entité User
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Crypter le mot de passe en utilisant le service UserPasswordHasherInterface
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            // Persiste l'entité User dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Générer un URL signé et l'envoyer par e-mail à l'utilisateur pour vérification
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@blogbooks.com', 'No Reply'))
                    ->to($user->getEmail())
                    ->subject('Veuillez confirmer votre e-mail')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            // Rediriger l'utilisateur vers la page de connexion après l'inscription
            return $this->redirectToRoute('app_login');
        }

        // Rendre la vue du formulaire d'inscription
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        // Restreindre l'accès à cette route uniquement aux utilisateurs authentifiés
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Valider le lien de confirmation d'e-mail, définir User::isVerified=true et persister
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            // En cas d'erreur, afficher un message flash approprié
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            // Rediriger l'utilisateur vers la page d'inscription en cas d'erreur
            return $this->redirectToRoute('app_register');
        }

        // Afficher un message flash pour confirmer la vérification de l'adresse e-mail
        $this->addFlash('success', 'Votre adresse e-mail a été vérifiée.');

        // Rediriger l'utilisateur vers la page d'inscription
        return $this->redirectToRoute('app_register');
    }
}
