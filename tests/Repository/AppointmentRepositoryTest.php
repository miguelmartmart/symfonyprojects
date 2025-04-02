<?php
namespace App\Tests\Repository;

use App\Entity\Cita;
use App\Entity\Cliente;
use App\Entity\Vehiculo;
use App\Enum\EstadoCita;
use App\Enum\VehiculoTipo;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class AppointmentRepositoryTest extends KernelTestCase
{
    public function testCanPersistAndFetchAppointment(): void
    {
        self::bootKernel();
        $em = static::getContainer()->get('doctrine')->getManager();

        $cliente = new Cliente();
        $cliente->setNombre('Test');
        $cliente->setCreatedAt(new \DateTimeImmutable());
$cliente->setUpdatedAt(new \DateTimeImmutable());
        $em->persist($cliente);

        $vehiculo = new Vehiculo();
        $vehiculo->setMarca('TestMarca')
                 ->setModelo('TestModelo')
                 ->setTipo(VehiculoTipo::CAR)
                 ->setCliente($cliente);
                 $vehiculo->setCreatedAt(new \DateTimeImmutable());
$vehiculo->setUpdatedAt(new \DateTimeImmutable());
        $em->persist($vehiculo);

        $cita = new Cita();
        $cita->setCliente($cliente)
             ->setVehiculo($vehiculo)
             ->setFechaCita(new \DateTime())
             ->setEstado(EstadoCita::PENDIENTE);
             $cita->setCreatedAt(new \DateTimeImmutable());
$cita->setUpdatedAt(new \DateTimeImmutable());


        $em->persist($cita);
        $em->flush();

        $repo = $em->getRepository(Cita::class);
        $fetched = $repo->find($cita->getId());

        $this->assertNotNull($fetched);
        $this->assertEquals(EstadoCita::PENDIENTE, $fetched->getEstado());
    }
}
