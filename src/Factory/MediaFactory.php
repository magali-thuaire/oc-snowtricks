<?php

namespace App\Factory;

use App\Entity\Media;
use App\Repository\MediaRepository;
use Doctrine\ORM\NonUniqueResultException;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<Media>
 *
 * @method static Media|Proxy createOne(array $attributes = [])
 * @method static Media[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static Media|Proxy find(object|array|mixed $criteria)
 * @method static Media|Proxy findOrCreate(array $attributes)
 * @method static Media|Proxy first(string $sortedField = 'id')
 * @method static Media|Proxy last(string $sortedField = 'id')
 * @method static Media|Proxy random(array $attributes = [])
 * @method static Media|Proxy randomOrCreate(array $attributes = [])
 * @method static Media[]|Proxy[] all()
 * @method static Media[]|Proxy[] findBy(array $attributes)
 * @method static Media[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static Media[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static MediaRepository|RepositoryProxy repository()
 * @method Media|Proxy create(array|callable $attributes = [])
 */
final class MediaFactory extends ModelFactory
{
    public function __construct()
    {
        parent::__construct();
    }

    protected function getDefaults(): array
    {
        return [
            'type' => self::faker()->randomKey(Media::TYPE),
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
            // ->afterInstantiate(function(Media $media): void {})
        ;
    }

    protected static function getClass(): string
    {
        return Media::class;
    }

    /**
     * @throws NonUniqueResultException
     */
    public static function getFeaturedImage(?string $search): ?Media
    {
        $search = str_replace(' ', '', $search);
        return  MediaFactory::repository()
                    ->createQueryBuilder('m')
                    ->andWhere('m.file LIKE :title')
                    ->setParameter('title', "%$search%")
                    ->getQuery()
                    ->setMaxResults(1)
                    ->getOneOrNullResult();
    }

    public static function getMedias(?string $search): ?array
    {
        $search = str_replace(' ', '', $search);
        return  MediaFactory::repository()
                    ->createQueryBuilder('m')
                    ->andWhere('m.file LIKE :title')
                    ->setParameter('title', "%$search%")
                    ->getQuery()
                    ->getResult();
    }
}
