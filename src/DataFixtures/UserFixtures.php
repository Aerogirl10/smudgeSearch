<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{

    private $passwordEncoder;
    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);

        $user = new User();
        $user->setUsername('Fixture user');
        $user->setEmail("fix@f.com");
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'the_new_password'
        ));
        $manager->persist($user);

        $manager->flush();

        $user = new User();
        $user->setUsername('fixture2');
        $user->setEmail("fix12313@f.com");
        $user->setRoles(['ROLE_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'test'
        ));
        $manager->persist($user);

        $manager->flush();

        $user = new User();
        $user->setUsername('admin');
        $user->setEmail("admin@admin.com");
        $user->setRoles(['ROLE_ADMIN', 'ROLE_SUPER_ADMIN']);
        $user->setPassword($this->passwordEncoder->encodePassword(
            $user,
            'admin'
        ));
        $manager->persist($user);

        $manager->flush();
    }
}
