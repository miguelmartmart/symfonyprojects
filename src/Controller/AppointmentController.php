<?php
// src/Controller/AppointmentController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Appointment;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class AppointmentController extends AbstractController {
    /**
     * @Route("/appointments", name="appointments", methods={"GET"})
     */
    public function list(EntityManagerInterface $em): Response {
        $appointments = $em->getRepository(Appointment::class)->findAll();
        return $this->render("appointments/list.html.twig", ["appointments" => $appointments]);
    }

    // Aquí se agregarían métodos para crear y editar citas, incluyendo la lógica para gestionar 'vehicleType'
}
