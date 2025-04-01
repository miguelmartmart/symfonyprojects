<?php
namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Cita;
use App\Entity\Cliente;
use App\Entity\Vehiculo;
use App\Enum\EstadoCita;
use App\Enum\VehiculoTipo;

class AppointmentPersistenceTest extends KernelTestCase
{
    private ?EntityManagerInterface $entityManager;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->entityManager = static::getContainer()->get('doctrine')->getManager();
    }

    public function testCreateAndRetrieveAppointment(): void
    {
        // Cliente
        $cliente = new Cliente();
        $cliente->setNombre('Test User')
            ->setTelefono('999-999')
            ->setEmail('test@example.com')
            ->setDireccion('Calle Prueba')
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());

        $this->entityManager->persist($cliente);

        // Vehiculo
        $vehiculo = new Vehiculo();
        $vehiculo->setCliente($cliente)
            ->setMarca('Ford')
            ->setModelo('Focus')
            ->setTipo(VehiculoTipo::CAR)
            ->setAnio(2020)
            ->setMatricula('TEST-123')
            ->setCreatedAt(new \DateTime())
            ->setUpdatedAt(new \DateTime());

        $this->entityManager->persist($vehiculo);

        // Cita
        $appointment = new Cita();
        $appointment->setCliente($cliente)
            ->setVehiculo($vehiculo)
            ->setFechaCita(new \DateTime('tomorrow'))
            ->setEstado(EstadoCita::CONFIRMADA)
            ->setObservaciones('Prueba de integración');

        $this->entityManager->persist($appointment);
        $this->entityManager->flush();
        $this->entityManager->clear();

        // Recuperación y aserciones
        $repo = $this->entityManager->getRepository(Cita::class);
        $stored = $repo->find($appointment->getId());

        $this->assertNotNull($stored);
        $this->assertEquals('Prueba de integración', $stored->getObservaciones());
        $this->assertEquals(EstadoCita::CONFIRMADA, $stored->getEstado());
        $this->assertEquals('Ford', $stored->getVehiculo()->getMarca());
    }

    protected function tearDown(): void
    {
        parent::tearDown();
        $this->entityManager->close();
        $this->entityManager = null;
    }
}
