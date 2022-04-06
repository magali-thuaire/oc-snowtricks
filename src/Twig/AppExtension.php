<?php

namespace App\Twig;

use App\Entity\User;
use App\Service\UploaderHelper;
use Liip\ImagineBundle\Imagine\Data\DataManager;
use Liip\ImagineBundle\Imagine\Filter\FilterManager;
use Psr\Container\ContainerInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Contracts\Service\ServiceSubscriberInterface;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension implements ServiceSubscriberInterface
{
    private ContainerInterface $container;
    private FilterManager $filterManager;
    private DataManager $dataManager;

    public function __construct(ContainerInterface $container, FilterManager $filterManager, DataManager $dataManager)
    {
        $this->container = $container;
        $this->filterManager = $filterManager;
        $this->dataManager = $dataManager;
    }

    public function getFilters(): array
    {
        return [
            // If your filter generates SAFE HTML, you should add a third
            // parameter: ['is_safe' => ['html']]
            // Reference: https://twig.symfony.com/doc/2.x/advanced.html#automatic-escaping
            new TwigFilter('anonymous_user', [$this, 'getAnonymousUser']),
            new TwigFilter('avatar', [$this, 'getAvatar']),
        ];
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('uploaded_asset', [$this, 'getUploadedAssetPath']),
        ];
    }

    public function getAnonymousUser(?User $user): string
    {
        if (!$user) {
            return 'anonymous';
        }

        return $user->getUsername();
    }

    public function getAvatar(?User $user): string
    {
        if (!$user) {
            return 'https://ui-avatars.com/api/?' . http_build_query([
                    'name' => 'anonymous',
                    'size' => '32',
                    'background' => 'random',
                    'color' => 'fff',
                ]);
        }

        if (!$user->getAvatar()) {
            return $user->getAvatarUri();
        }
        return $this->getUploadedAssetPath($user->getAvatarUri());
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
