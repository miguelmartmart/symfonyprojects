<?php
namespace App\Tests\Entity;

use App\Entity\Cliente;
use PHPUnit\Framework\TestCase;

class ClienteTest extends TestCase
{
    public function testSetAndGetNombre(): void
    {
        $cliente = new Cliente();
        $cliente->setNombre('Juan Pérez');

        $this->assertEquals('Juan Pérez', $cliente->getNombre());
    }

    public function testSetAndGetTelefono(): void
    {
        $cliente = new Cliente();
        $cliente->setTelefono('555-1234');

        $this->assertEquals('555-1234', $cliente->getTelefono());
    }
}
