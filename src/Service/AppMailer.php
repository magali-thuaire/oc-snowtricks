<?php

namespace App\Service;

use App\Entity\User;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use SymfonyCasts\Bundle\ResetPassword\Model\ResetPasswordToken;

class AppMailer
{
    private EmailVerifier $emailVerifier;
    private MailerInterface $mailer;
    private TranslatorInterface $translator;

    public function __construct(EmailVerifier $emailVerifier, MailerInterface $mailer, TranslatorInterface $translator)
    {
        $this->emailVerifier = $emailVerifier;
        $this->mailer = $mailer;
        $this->translator = $translator;
    }

    public function sendEmailConfirmation(User $user)
    {
        // generate a signed url and email it to the user
        $this->emailVerifier->sendEmailConfirmation(
            'app_verify_email',
            $user,
            (new TemplatedEmail())
                ->to($user->getEmail())
                ->subject($this->translator->trans('verify_email.subject', [], 'email'))
                ->htmlTemplate('mail/registration/confirmation_email.html.twig')
        );
    }

    public function sendEmailResetPassword(User $user, ResetPasswordToken $resetToken)
    {
        $email = (new TemplatedEmail())
            ->to($user->getEmail())
            ->subject($this->translator->trans('reset_password.subject', [], 'email'))
            ->htmlTemplate('mail/reset_password/reset_password_email.html.twig')
            ->context([
                'resetToken' => $resetToken,
            ])
        ;

        try {
            $this->mailer->send($email);
        } catch (TransportExceptionInterface $e) {
        }
    }
}
