<?php
namespace App\Tests\Entity;

use App\Entity\Vehiculo;
use App\Entity\Cliente;
use App\Enum\VehiculoTipo;
use PHPUnit\Framework\TestCase;

class VehiculoTest extends TestCase
{
    public function testVehiculoData(): void
    {
        $vehiculo = new Vehiculo();
        $cliente = new Cliente();
        $vehiculo->setCliente($cliente);
        $vehiculo->setMarca('Toyota');
        $vehiculo->setModelo('Corolla');
        $vehiculo->setTipo(VehiculoTipo::CAR);

        $this->assertSame($cliente, $vehiculo->getCliente());
        $this->assertEquals('Toyota', $vehiculo->getMarca());
        $this->assertEquals('Corolla', $vehiculo->getModelo());
        $this->assertEquals(VehiculoTipo::CAR, $vehiculo->getTipo());
    }
}
