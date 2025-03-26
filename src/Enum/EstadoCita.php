<?php
namespace App\Enum;

enum EstadoCita: string
{
    case PENDIENTE = 'pendiente';
    case CONFIRMADA = 'confirmada';
    case COMPLETADA = 'completada';
    case CANCELADA = 'cancelada';

    public function label(): string
    {
        return match($this) {
            self::PENDIENTE => 'Pendiente',
            self::CONFIRMADA => 'Confirmada',
            self::COMPLETADA => 'Completada',
            self::CANCELADA => 'Cancelada',
        };
    }
}
