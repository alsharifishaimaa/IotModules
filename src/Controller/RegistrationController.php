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
<<<<<<< HEAD
        $user = new User();
=======
        // Créer une nouvelle instance de l'entité User
        $user = new User();

        // Créer le formulaire d'inscription et le lier à l'entité User
>>>>>>> 91f9245964b27b13bebb8c597a8b31c82c6357ea
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
<<<<<<< HEAD
            // encode the plain password
=======
            // Crypter le mot de passe en utilisant le service UserPasswordHasherInterface
>>>>>>> 91f9245964b27b13bebb8c597a8b31c82c6357ea
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

<<<<<<< HEAD
            $entityManager->persist($user);
            $entityManager->flush();

            // generate a signed url and email it to the user
=======
            // Persiste l'entité User dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Générer un URL signé et l'envoyer par e-mail à l'utilisateur pour vérification
>>>>>>> 91f9245964b27b13bebb8c597a8b31c82c6357ea
            $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                (new TemplatedEmail())
                    ->from(new Address('no-reply@blogbooks.com', 'No Reply'))
                    ->to($user->getEmail())
<<<<<<< HEAD
                    ->subject('Please Confirm your Email')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

=======
                    ->subject('Veuillez confirmer votre e-mail')
                    ->htmlTemplate('registration/confirmation_email.html.twig')
            );

            // Rediriger l'utilisateur vers la page de connexion après l'inscription
            return $this->redirectToRoute('app_login');
        }

        // Rendre la vue du formulaire d'inscription
>>>>>>> 91f9245964b27b13bebb8c597a8b31c82c6357ea
        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form,
        ]);
    }
<<<<<<< HEAD

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $this->getUser());
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));

            return $this->redirectToRoute('app_register');
        }

        // @TODO Change the redirect on success and handle or remove the flash message in your templates
        $this->addFlash('success', 'Your email address has been verified.');

=======
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
>>>>>>> 91f9245964b27b13bebb8c597a8b31c82c6357ea
        return $this->redirectToRoute('app_register');
    }
}
