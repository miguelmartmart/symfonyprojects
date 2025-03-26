<?php
namespace App\Tests\Entity;

use App\Enum\EstadoCita;
use PHPUnit\Framework\TestCase;

class EstadoCitaTest extends TestCase
{
    public function testLabel(): void
    {
        $this->assertEquals('Confirmada', EstadoCita::CONFIRMADA->label());
        $this->assertEquals('Pendiente', EstadoCita::PENDIENTE->label());
    }
}
