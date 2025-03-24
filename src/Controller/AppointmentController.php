<?php
// src/Controller/AppointmentController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AppointmentController extends AbstractController {
    #[Route('/appointments', name: 'appointments', methods: ['GET'])]
    public function list(): Response {
        // Aquí obtendrías y pasarías los datos (por ahora puedes mostrar un mensaje de prueba)
        // return new Response('Listado de citas');
        // O bien, renderiza una plantilla:
        return $this->render('appointments/list.html.twig', ['appointments' => []]);
    }
}
