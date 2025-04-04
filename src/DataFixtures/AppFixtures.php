<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Cliente;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $cliente = new Cliente();
        $cliente->setNombre('Juan Test');
        $cliente->setTelefono('600123456');

        $manager->persist($cliente);
        $manager->flush();
    }
}
