<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $userPasswordHasher)
    {
    }

    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $hashedPassword = $this->userPasswordHasher->hashPassword($user, '1234567890');
        $user
            ->setName('Arcadia')
            ->setFirstname('Jose')
            ->setEmail('jose@arcadia.org')
            ->setRoles(['ROLE_BOSS'])
            ->setPassword($hashedPassword);
        $manager->persist($user);

        $manager->flush();
    }
}
