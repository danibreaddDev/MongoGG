<?php

namespace App\DataFixtures;

use App\Entity\Cuentas;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class CuentasFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 30; $i++) {
            $cuenta = new Cuentas();
            $cuenta->setNombre("no t ho mereixes #mongo");
            $cuenta->setEnlace("prueba");
            $cuenta->setValoresCreadoEn();  
            $cuenta->setUsuario($this->getReference(UserFixtures::USUARIO_ADMIN_REFERENCIA));
            $cuenta->setJuego("Valorant");
            $manager->persist($cuenta);
            $manager->flush();
        }
    }
    public function getDependencies()
    {
        return [
            UserFixtures::class
        ];
    }
}
