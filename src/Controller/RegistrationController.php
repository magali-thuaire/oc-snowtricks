<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\UserRepository;
use App\Service\EmailVerifier;
use App\Service\Mailer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;

class RegistrationController extends AbstractController
{
    private Mailer $mailer;
    private EmailVerifier $emailVerifier;

    public function __construct(Mailer $mailer, EmailVerifier $emailVerifier)
    {
        $this->mailer = $mailer;
        $this->emailVerifier = $emailVerifier;
    }

    #[Route('/register', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

            $entityManager->persist($user);
            $entityManager->flush();

            $this->mailer->sendEmailConfirmation($user);

            $this->addFlash('success', 'registration.success');
            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }

    #[Route('/verify/email', name: 'app_verify_email')]
    public function verifyUserEmail(Request $request, TranslatorInterface $translator, UserRepository $userRepository): Response
    {
        $id = $request->get('id'); // retrieve the user id from the url
        // Verify the user id exists and is not null
        if (null === $id) {
            return $this->redirectToRoute('app_trick');
        }

        $user = $userRepository->find($id);

       // Ensure the user exists in persistence
        if (null === $user) {
            return $this->redirectToRoute('app_trick');
        }

        // validate email confirmation link, sets User::isVerified=true and persists
        try {
            $this->emailVerifier->handleEmailConfirmation($request, $user);
            $this->addFlash('success', 'verify_email.success');
        } catch (VerifyEmailExceptionInterface $exception) {
            $this->addFlash('verify_email_error', $translator->trans($exception->getReason(), [], 'VerifyEmailBundle'));
        }

        return $this->redirectToRoute('app_login');
    }

    #[Route("/verify/resend", name: "app_verify_resend_email")]
    public function resendVerifyEmail(AuthenticationUtils $authenticationUtils, Request $request, UserRepository $userRepository): RedirectResponse|Response
    {
        if ($request->isMethod('POST')) {
            $lastUsername = $authenticationUtils->getLastUsername();
            $user = $userRepository->findOneBy(['username' => $lastUsername]);

            // generate a signed url and email it to the user
            $this->mailer->sendEmailConfirmation($user);

            // clear the error for verifying email
            $authenticationUtils->getLastAuthenticationError();

            $this->addFlash('success', 'verify_email.new');
            return $this->redirectToRoute('app_login');
        }
        return $this->render('registration/resend_verify_email.html.twig');
    }
}
