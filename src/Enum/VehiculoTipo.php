<?php
// src/Enum/VehiculoTipo.php

namespace App\Enum;

enum VehiculoTipo: string
{
    case CAR = 'car';
    case MOTORCYCLE = 'motorcycle';
    case TRUCK = 'truck';
    case OTHER = 'other';

    public function label(): string
    {
        return match($this) {
            self::CAR => 'Coche',
            self::MOTORCYCLE => 'Moto',
            self::OTHER => 'Otro',
        };
    }
}
