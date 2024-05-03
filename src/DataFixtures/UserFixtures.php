<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const USUARIO_ADMIN_REFERENCIA = "admin-admin";
    public const USUARIO_USER_REFERENCIA = "user-user";
    private UserPasswordHasherInterface $hasher;
    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }
    public function load(ObjectManager $manager): void
    {
        $usuario = new User();
        $usuario->setEmail("admin@mongoGG.com");
        $usuario->setRoles(['ROLE_ADMIN']);
        $contraseña = $this->hasher->hashPassword($usuario, 'admin');
        $usuario->setPassword($contraseña);
        $usuario->setUltimoAcceso(new \DateTime());
        $usuario->setIsVerified(true);
        $manager->persist($usuario);
        $manager->flush();
        $this->addReference(self::USUARIO_ADMIN_REFERENCIA, $usuario);
    }
}
