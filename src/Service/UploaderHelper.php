<?php

namespace App\Service;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\Asset\Context\RequestStackContext;
use Symfony\Component\HttpFoundation\File\File;

class UploaderHelper
{
    public const TRICK_IMAGE = 'trick_images';
    private string $uploadsPath;
    private RequestStackContext $requestStackContext;

    public function __construct(string $uploadsPath, RequestStackContext $requestStackContext)
    {
        $this->uploadsPath = $uploadsPath;
        $this->requestStackContext = $requestStackContext;
    }

    public function uploadTrickImage(File $file, ?string $trickTitle = null, bool $suffix = true): string
    {
        $destination = $this->uploadsPath . '/' . self::TRICK_IMAGE;

        $filename = $trickTitle ?? explode('-', pathinfo($file->getFilename(), PATHINFO_FILENAME))[0];

        if (!$suffix) {
            $newFilename = Urlizer::urlize($filename) . '.' . $file->guessExtension();
        } else {
            $newFilename = Urlizer::urlize($filename) . '-' . uniqid() . '.' . $file->guessExtension();
        }

        $file->move(
            $destination,
            $newFilename
        );

        return $newFilename;
    }

    public function getPublicPath(string $path): string
    {
        return $this->requestStackContext
            ->getBasePath() . '/uploads/' . $path;
    }
}
