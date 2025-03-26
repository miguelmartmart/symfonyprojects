<?php
namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Appointment;
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
        $this->entityManager = self::$kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    public function testCreateAndRetrieveAppointment(): void
    {
        // Crear Cliente
        $cliente = new Cliente();
        $cliente->setNombre('Test User')
            ->setTelefono('999-999')
            ->setEmail('test@example.com')
            ->setDireccion('Calle Prueba');

        $this->entityManager->persist($cliente);

        // Crear Vehículo
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

        // Crear Cita
        $appointment = new Appointment();
        $appointment->setCliente($cliente);
        $appointment->setVehiculo($vehiculo);
        $appointment->setFechaCita(new \DateTime('tomorrow'));
        $appointment->setEstado(EstadoCita::CONFIRMADA);
        $appointment->setObservaciones('Prueba de integración');

        $this->entityManager->persist($appointment);
        $this->entityManager->flush();
        $this->entityManager->clear();

        // Recuperar y comprobar
        $repo = $this->entityManager->getRepository(Appointment::class);
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
