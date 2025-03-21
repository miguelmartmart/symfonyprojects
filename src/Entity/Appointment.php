<?php
// src/Entity/Appointment.php
namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="appointments")
 */
class Appointment {
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $customerName;

    /**
     * @ORM\Column(type="datetime")
     */
    private $appointmentDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $vehicleType; // 'car', 'motorcycle', 'other', etc.

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $vehicleModel;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $repairType;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $estimatedRepairTime;

    // Getters y setters...
}
