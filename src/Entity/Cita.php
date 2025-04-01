<?php
// src/Entity/Cita.php

namespace App\Entity;

use App\Enum\EstadoCita;
use App\Repository\CitaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CitaRepository::class)]
class Cita
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Cliente::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cliente $cliente = null;

    #[ORM\ManyToOne(targetEntity: Vehiculo::class)]
    #[ORM\JoinColumn(nullable: false)]
    private ?Vehiculo $vehiculo = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $fechaCita;

    #[ORM\Column(type: 'string', enumType: EstadoCita::class)]
    private EstadoCita $estado;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $observaciones = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCliente(): ?Cliente
    {
        return $this->cliente;
    }

    public function setCliente(?Cliente $cliente): self
    {
        $this->cliente = $cliente;
        return $this;
    }

    public function getVehiculo(): ?Vehiculo
    {
        return $this->vehiculo;
    }

    public function setVehiculo(?Vehiculo $vehiculo): self
    {
        $this->vehiculo = $vehiculo;
        return $this;
    }

    public function getFechaCita(): \DateTimeInterface
    {
        return $this->fechaCita;
    }

    public function setFechaCita(\DateTimeInterface $fechaCita): self
    {
        $this->fechaCita = $fechaCita;
        return $this;
    }

    public function getEstado(): EstadoCita
    {
        return $this->estado;
    }

    public function setEstado(EstadoCita $estado): self
    {
        $this->estado = $estado;
        return $this;
    }
    public function getEstadoLabel(): string
{
    return $this->estado->label();
}


    public function getObservaciones(): ?string
    {
        return $this->observaciones;
    }

    public function setObservaciones(?string $observaciones): self
    {
        $this->observaciones = $observaciones;
        return $this;
    }

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getUpdatedAt(): \DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}