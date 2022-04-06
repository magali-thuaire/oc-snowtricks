<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\Trick;
use App\Factory\CommentFactory;
use App\Factory\MediaFactory;
use App\Factory\TrickFactory;
use App\Factory\UserFactory;
use App\Service\UploaderHelper;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\File;

class AppFixtures extends Fixture
{
    private UploaderHelper $uploaderHelper;

    public function __construct(UploaderHelper $uploaderHelper)
    {
        $this->uploaderHelper = $uploaderHelper;
    }

    public function load(ObjectManager $manager): void
    {

        // Load Users
        UserFactory::new()
           ->withAttributes([
               'email' => 'magali@snowtricks.com',
               'username' => 'magali',
               'plainPassword' => 'snowtricks',
               'isVerified' => true
           ])
           ->create();

        UserFactory::new()
           ->withAttributes([
               'email' => 'admin@snowtricks.com',
               'username' => 'admin',
               'plainPassword' => 'snowtricks',
               'isVerified' => true
           ])
            ->promoteRole('ROLE_ADMIN')
           ->create();

        UserFactory::new()
           ->withAttributes([
               'email' => 'superadmin@snowtricks.com',
               'username' => 'superadmin',
               'plainPassword' => 'snowtricks',
               'isVerified' => true
           ])
           ->promoteRole('ROLE_SUPER_ADMIN')
           ->create();

        UserFactory::new()->createMany(10);

        // Load Medias
        $images = scandir(__DIR__ . '/images');

        foreach ($images as $image) {
            if (!in_array($image, ['.', '..'])) {
                $imageFilename = $this->initializeUploadedImage($image);

                MediaFactory::new()
                    ->withAttributes([
                        'type' => array_search('image', Media::TYPE),
                        'file' => $imageFilename
                    ])
                    ->create();
            }
        }

        // Load Tricks
        $tricks_data = [
            'tail grab'         => ['grab', 'The rear hand grabs the tail of the snowboard.'],
            'nose grab'         => ['grab', 'The front hand grabs the nose of the snowboard.'],
            'mute'              => ['grab', 'The front hand grabs the toe edge either between the toes or in front of the front foot.'],
            'method'            => ['grab', 'A fundamental trick performed by bending the knees to lift the board behind the rider\'s back, and grabbing the heel edge of the snowboard with the leading hand.'],
            'japan'             => ['grab', 'the front hand grabs the toe edge in between the feet and the front knee is pulled to the board.'],
            'indy'              => ['grab', 'A fundamental trick performed by grabbing the toe edge between the bindings with the trailing hand.'],
            'bloody dracula'    => ['grab', 'A trick in which the rider grabs the tail of the board with both hands.'],
            'front flip'        => ['flip and inverted rotation', 'Flipping forward off of a jump.'],
            'back flip'         => ['flip and inverted rotation', 'Flipping backward off of a jump.'],
            'layout back flip'  => ['flip and inverted rotation', 'A variation of a regular backflip, but with the body fully extended.'],
        ];

        foreach ($tricks_data as $trick_title => $trick_data) {
            TrickFactory::new()
                ->withAttributes([
                    'title' => $trick_title,
                    'category' => array_search($trick_data[0], Trick::CATEGORY),
                    'description' => $trick_data[1]
                ])
                ->create();
        }

        // Load Comments
        CommentFactory::new()->createMany(20);

        $manager->flush();
    }

    private function initializeUploadedImage(string $image): string
    {
        $fs = new Filesystem();
        $targetPath = sys_get_temp_dir() . '/' . $image;
        $fs->copy(__DIR__ . '/images/' . $image, $targetPath, true);

        if ($image === 'default.jpg') {
            return $this->uploaderHelper->uploadTrickImage(new File($targetPath), null, false);
        } else {
            return $this->uploaderHelper->uploadTrickImage(new File($targetPath));
        }
    }
}
