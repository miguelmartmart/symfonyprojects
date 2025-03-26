<?php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppointmentControllerTest extends WebTestCase
{
    public function testAppointmentsPageIsAccessible(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/appointments');

        // Verifica que la respuesta sea exitosa (HTTP 200)
        $this->assertResponseIsSuccessful();

        // Verifica que exista un título <h1>
        $this->assertSelectorExists('h1');

        // Verifica que el contenido del <h1> contenga texto esperado
        $this->assertSelectorTextContains('h1', 'Gestión de Citas');
    }
}
