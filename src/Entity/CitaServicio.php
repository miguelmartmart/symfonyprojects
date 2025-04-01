<?php

namespace App\Entity;

use App\Repository\CitaServicioRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CitaServicioRepository::class)]
#[ORM\Table(name: 'cita_servicios')]
class CitaServicio
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Cita::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Cita $cita;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Servicio::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Servicio $servicio;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $tiempoEstimado = null;

    public function getCita(): Cita
    {
        return $this->cita;
    }

    public function setCita(Cita $cita): self
    {
        $this->cita = $cita;
        return $this;
    }

    public function getServicio(): Servicio
    {
        return $this->servicio;
    }

    public function setServicio(Servicio $servicio): self
    {
        $this->servicio = $servicio;
        return $this;
    }

    public function getTiempoEstimado(): ?int
    {
        return $this->tiempoEstimado;
    }

    public function setTiempoEstimado(?int $tiempoEstimado): self
    {
        $this->tiempoEstimado = $tiempoEstimado;
        return $this;
    }
}
