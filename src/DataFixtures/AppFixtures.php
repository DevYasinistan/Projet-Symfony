<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('amcem.menuiserie@gmail.com');
        $user->setPassword('admin');
        $user->setRoles(['ROLE-ADMIN']);
        $manager->persist($user);

        $manager->flush();
    }
}
