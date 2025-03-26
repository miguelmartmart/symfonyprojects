<?php

namespace App\Controller;

use App\Repository\AppointmentRepository;
use App\Repository\ClienteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AppointmentController extends AbstractController
{
    #[Route('/appointments', name: 'appointments')]
    public function list(
        AppointmentRepository $appointmentRepository,
        ClienteRepository $clienteRepository
    ): Response {
        $appointments = $appointmentRepository->findAll();

        $marcas = array_unique(array_map(
            fn($cita) => $cita->getVehiculo()->getMarca(),
            $appointments
        ));
        sort($marcas);

        $estados = array_unique(array_map(
            fn($cita) => $cita->getEstado()->value,
            $appointments
        ));
        sort($estados);

        $clientes = $clienteRepository->findAll();

        return $this->render('appointments/list.html.twig', [
            'appointments' => $appointments,
            'marcas' => $marcas,
            'estados' => $estados,
            'clientes' => $clientes
        ]);
    }
}
