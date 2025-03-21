<?php
// tests/Controller/AppointmentControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppointmentControllerTest extends WebTestCase {
    public function testAppointmentList() {
        $client = static::createClient();
        $crawler = $client->request("GET", "/appointments");
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains("h1", "Gestión de Citas - Taller de Vehículos");
    }
}
