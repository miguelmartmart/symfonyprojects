<?php
// src/Enum/VehiculoTipo.php

namespace App\Enum;

enum VehiculoTipo: string
{
    case CAR = 'car';
    case MOTORCYCLE = 'motorcycle';
    case OTHER = 'other';
}