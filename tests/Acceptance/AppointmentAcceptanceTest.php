<?php
namespace App\Tests\Acceptance;

use Symfony\Component\Panther\PantherTestCase;

class AppointmentAcceptanceTest extends PantherTestCase
{
    public function testAppointmentListView(): void
    {
        putenv('PANTHER_CHROME_ARGUMENTS=--no-sandbox --headless --disable-gpu --user-data-dir=/tmp/panther-' . uniqid());

        $client = self::createPantherClient();

        $crawler = $client->request('GET', '/appointments');

        $this->assertSelectorTextContains('h1', 'Gestión de Citas');
        $this->assertGreaterThan(0, $crawler->filter('table')->count());
    }
}
