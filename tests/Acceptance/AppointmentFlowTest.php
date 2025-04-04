<?php
namespace App\Tests\Acceptance;

use Symfony\Component\Panther\PantherTestCase;

class AppointmentFlowTest extends PantherTestCase
{
    public function testAppointmentListFiltering(): void
    {
        $client = static::createPantherClient(); // esto sí es Panther

        $crawler = $client->request('GET', '/appointments');

        // En Panther no se usa assertResponseIsSuccessful directamente
        $this->assertSelectorExists('select#marca');

$marcaOptions = $crawler->filter('select#marca option')->reduce(function ($node) {
    return trim($node->attr('value')) !== '';
});

if ($marcaOptions->count() === 0) {
    $this->markTestSkipped('No hay marcas disponibles para filtrar.');
}

$optionNode = $marcaOptions->first();

        $marcaValue = $optionNode->attr('value');

        $form = $crawler->filter('form#filtersForm')->form([
            'marca' => $marcaValue,
        ]);

        $crawler = $client->submit($form);

        // Espera a que se renderice completamente
        $client->waitFor('.table tbody tr');

        $rows = $crawler->filter('table tbody tr');
        $this->assertGreaterThan(0, $rows->count(), 'La tabla no contiene resultados después de filtrar por marca.');
    }
}
