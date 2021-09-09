<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use App\Entity\Admin;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture 
{

    private $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('User');
        $user->setRoles(['ROLE_USER']);
        $password = $this->encoder->encodePassword($user, 'user');
        $user->setPassword($password);
        $manager->persist($user);

        $admin = new Admin();
        $admin->setUsername('linkivia');
        $admin->setRoles(['ROLE_ADMIN']);
        $password = $this->encoder->encodePassword($admin, 'linkivia');
        $admin->setPassword($password);
        $manager->persist($admin);


        $manager->flush();
    }
}
