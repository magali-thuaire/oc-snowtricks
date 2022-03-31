<?php

namespace App\Factory;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Zenstruck\Foundry\RepositoryProxy;
use Zenstruck\Foundry\ModelFactory;
use Zenstruck\Foundry\Proxy;

/**
 * @extends ModelFactory<User>
 *
 * @method static User|Proxy createOne(array $attributes = [])
 * @method static User[]|Proxy[] createMany(int $number, array|callable $attributes = [])
 * @method static User|Proxy find(object|array|mixed $criteria)
 * @method static User|Proxy findOrCreate(array $attributes)
 * @method static User|Proxy first(string $sortedField = 'id')
 * @method static User|Proxy last(string $sortedField = 'id')
 * @method static User|Proxy random(array $attributes = [])
 * @method static User|Proxy randomOrCreate(array $attributes = [])
 * @method static User[]|Proxy[] all()
 * @method static User[]|Proxy[] findBy(array $attributes)
 * @method static User[]|Proxy[] randomSet(int $number, array $attributes = [])
 * @method static User[]|Proxy[] randomRange(int $min, int $max, array $attributes = [])
 * @method static UserRepository|RepositoryProxy repository()
 * @method User|Proxy create(array|callable $attributes = [])
 */
final class UserFactory extends ModelFactory
{
    private UserPasswordHasherInterface $user_password_hasher;

    public function __construct(UserPasswordHasherInterface $user_password_hasher)
    {
        parent::__construct();

        $this->user_password_hasher = $user_password_hasher;
    }

    public function promoteRole(string $role): self
    {
        $defaults = $this->getDefaults();

        $roles = array_merge($defaults['roles'], [
            $role
        ]);

        return $this->addState([
            'roles' => $roles,
        ]);
    }

    protected function getDefaults(): array
    {
        return [
            'username' => self::faker()->userName(),
            'roles' => [
                'ROLE_USER'
            ],
            'email' => self::faker()->email(),
            'plainPassword' => 'snowtricks',
            'isVerified' => true
        ];
    }

    protected function initialize(): self
    {
        // see https://symfony.com/bundles/ZenstruckFoundryBundle/current/index.html#initialization
        return $this
             ->afterInstantiate(function (User $user): void {
                if ($plainPassword = $user->getPlainPassword()) {
                    $user->setPassword($this->user_password_hasher->hashPassword($user, $plainPassword));
                }
             })
        ;
    }

    protected static function getClass(): string
    {
        return User::class;
    }
}
