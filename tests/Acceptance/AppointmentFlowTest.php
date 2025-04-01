<?php
namespace App\Tests\Acceptance;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AppointmentFlowTest extends WebTestCase
{
    public function testAppointmentListFiltering()
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/appointments');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorExists('select#marca');

        // Obtener el formulario por el <form> y establecer los valores de campos manualmente
        $form = $crawler->filter('form#filtersForm')->form([
            'marca' => 'Toyota', // name del select
        ]);

        $crawler = $client->submit($form);

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('td', 'Toyota');
    }
}
