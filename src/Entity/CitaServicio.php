<?php
// src/Entity/CitaServicio.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity]
#[ORM\Table(name: 'cita_servicios')]
class CitaServicio
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Appointment::class, inversedBy: 'citaServicios')]
    #[ORM\JoinColumn(name: 'cita_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private Appointment $cita;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Servicio::class)]
    #[ORM\JoinColumn(name: 'servicio_id', referencedColumnName: 'id', nullable: false, onDelete: 'CASCADE')]
    private Servicio $servicio;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $tiempoEstimado = null;

    // Getters y setters
    public function getCita(): Appointment { return $this->cita; }
    public function setCita(?Appointment $cita): self { $this->cita = $cita; return $this; }

    public function getServicio(): Servicio { return $this->servicio; }
    public function setServicio(Servicio $servicio): self { $this->servicio = $servicio; return $this; }

    public function getTiempoEstimado(): ?int { return $this->tiempoEstimado; }
    public function setTiempoEstimado(?int $tiempo): self { $this->tiempoEstimado = $tiempo; return $this; }
}
