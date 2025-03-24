<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/api/vehicle-models' => [[['_route' => 'api_vehicle_models', '_controller' => 'App\\Controller\\ApiController::getVehicleModels'], null, ['GET' => 0], null, false, false, null]],
        '/appointments' => [[['_route' => 'appointments', '_controller' => 'App\\Controller\\AppointmentController::list'], null, ['GET' => 0], null, false, false, null]],
        '/' => [[['_route' => 'homepage', '_controller' => 'App\\Controller\\DefaultController::index'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
    ],
    [ // $dynamicRoutes
    ],
    null, // $checkCondition
];
