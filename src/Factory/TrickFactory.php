<?php

namespace App\Factory;

use App\Entity\Trick;
use App\Repository\TrickRepository;
use DateTime;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Trick>
 *
 * @method static Trick|Proxy createOne(array $attributes = [])
 * @method static Trick[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Trick|Proxy find(object|array|mixed $criteria)
 * @method static Trick|Proxy findOrCreate(array $attributes)
 * @method static Trick|Proxy first(string $sortedField = 'id')
 * @method static Trick|Proxy last(string $sortedField = 'id')
 * @method static Trick|Proxy random(array $attributes = [])
 * @method static Trick|Proxy randomOrCreate(array $attributes = [])
 * @method static Trick[]|Proxy[] all()
 * @method static Trick[]|Proxy[] findBy(array $attributes)
 * @method static Trick[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Trick[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static TrickRepository|RepositoryProxy repository()
 * @method Trick|Proxy create(array|callable $attributes = [])
 */
final class TrickFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'title' => self::faker()->text(30),
            'description' => self::faker()->text(),
            'category' => self::faker()->randomKey(Trick::CATEGORY),
            'author' => UserFactory::random(),
            'createdAt' => self::faker()->dateTimeBetween('-30 days'),
            'updatedAt' => self::faker()->dateTime()
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
             ->afterInstantiate(function (Trick $trick): void {
                // Updated At
                if (self::faker()->boolean) {
                    $trick->setUpdatedAt(new DateTime('+1 day'));
                }
                // Medias
                if (!empty($medias = MediaFactory::getMedias($trick->getTitle()))) {
                    foreach ($medias as $media) {
                        $trick->addMedia($media);
                    }
                }
                // FeaturedImage
                if ($media = MediaFactory::getFeaturedImage($trick->getTitle())) {
                    $trick->setFeaturedImage($media);
                }
             })
        ;
    }

    public static function getTrick(?string $search) : ?Trick
    {
        return  TrickFactory::repository()
                    ->createQueryBuilder('t')
                    ->andWhere('t.title LIKE :title')
                    ->setParameter('title', "%$search%")
                    ->getQuery()
                    ->setMaxResults(1)
                    ->getOneOrNullResult();
    }

    protected static function getClass(): string
    {
        return Trick::class;
    }
}
