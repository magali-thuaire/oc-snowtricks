<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Exception;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAccountStatusException;
use Symfony\Component\Security\Http\Event\CheckPassportEvent;
use Symfony\Component\Security\Http\Event\LoginFailureEvent;

class CheckVerifiedUserSubscriber implements EventSubscriberInterface
{
    private UrlGeneratorInterface $urlGenerator;

    public function __construct(UrlGeneratorInterface $urlGenerator)
    {
        $this->urlGenerator = $urlGenerator;
    }

    /**
     * @throws Exception
     */
    public function onCheckPassport(CheckPassportEvent $event)
    {
        $passport = $event->getPassport();
        $user = $passport->getUser();

        if (!$user instanceof User) {
            throw new Exception('Unexpected user type');
        }

        if (!$user->isVerified()) {
            throw new CustomUserMessageAccountStatusException('user.verify_email');
        }
    }

    public function onLogginFailure(LoginFailureEvent $event)
    {
        if (!$event->getException() instanceof CustomUserMessageAccountStatusException) {
            return;
        }

        $response = new RedirectResponse($this->urlGenerator->generate('app_verify_resend_email'));
        $event->setResponse($response);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            CheckPassportEvent::class => ['onCheckPassport', -10],
            LoginFailureEvent::class => ['onLogginFailure']
        ];
    }
}
