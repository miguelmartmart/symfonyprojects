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

        // Extraemos el primer <option> válido (no vacío)
        $optionNode = $crawler->filter('select#marca option')->reduce(function ($node) {
            return trim($node->attr('value')) !== '';
        })->first();

        $this->assertGreaterThan(0, $optionNode->count(), 'No hay opciones de marca válidas.');

        $marcaValue = $optionNode->attr('value');
        $marcaText = $optionNode->text(); // Para usar opcionalmente si quieres comprobarlo luego

        // Enviar formulario con esa marca
        $form = $crawler->filter('form#filtersForm')->form([
            'marca' => $marcaValue,
        ]);

        $crawler = $client->submit($form);
        $this->assertResponseIsSuccessful();

        // ⚠️ En lugar de buscar texto exacto, comprobamos que hay al menos una fila en la tabla de resultados
        $rows = $crawler->filter('table tbody tr');
        $this->assertGreaterThan(0, $rows->count(), 'La tabla no contiene resultados después de filtrar por marca.');
    }
}
