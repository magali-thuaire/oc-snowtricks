<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\Trick;
use App\Factory\MediaFactory;
use App\Factory\TrickFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {

        // Load Users
        UserFactory::new()
           ->withAttributes([
               'email' => 'magali@snowtricks.com',
               'username' => 'magali',
               'plainPassword' => 'snowtricks'
           ])
           ->create();

        // Load Medias
        $images = scandir(getcwd() . '/assets/images/tricks');

        foreach ($images as $image) {
            if (!in_array($image, ['.', '..', 'default.jpg'])) {
                MediaFactory::new()
                    ->withAttributes([
                        'type' => array_search('image', Media::TYPE),
                        'file' => $image
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

        $manager->flush();
    }
}
