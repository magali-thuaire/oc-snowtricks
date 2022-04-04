<?php

namespace App\Twig;

use App\Entity\User;
use App\Service\UploaderHelper;
use Psr\Container\ContainerInterface;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension implements ServiceSubscriberInterface
{

    private ContainerInterface $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('anonymous_user', [$this, 'anonymousUser']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('uploaded_asset', [$this, 'getUploadedAssetPath']),
        ];
    }

    public function anonymousUser(?User $user): string
    {
        if (!$user) {
            return 'anonymous';
        }

        return $user->getUsername();
    }

    /**
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function getUploadedAssetPath(string $path): string
    {
        return $this->container
            ->get(UploaderHelper::class)
            ->getPublicPath($path)
        ;
    }

    public static function getSubscribedServices(): array
    {
        return [
            UploaderHelper::class,
        ];
    }
}
