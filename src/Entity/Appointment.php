<?php
// src/Entity/Appointment.php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use App\Repository\AppointmentRepository;
use App\Enum\EstadoCita;

#[ORM\Entity(repositoryClass: AppointmentRepository::class)]
#[ORM\Table(name: 'citas')]
class Appointment
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Cliente::class)]
    #[ORM\JoinColumn(name: 'cliente_id', referencedColumnName: 'id', nullable: false)]
    private Cliente $cliente;

    #[ORM\ManyToOne(targetEntity: Vehiculo::class)]
    #[ORM\JoinColumn(name: 'vehiculo_id', referencedColumnName: 'id', nullable: false)]
    private Vehiculo $vehiculo;

    #[ORM\Column(name: 'fecha_cita', type: 'datetime')]
    private \DateTimeInterface $fechaCita;

    #[ORM\Column(type: 'string', enumType: EstadoCita::class, options: ['default' => 'pendiente'])]
    private EstadoCita $estado;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $observaciones = null;

    #[ORM\OneToMany(mappedBy: 'cita', targetEntity: CitaServicio::class, cascade: ['persist', 'remove'])]
    private Collection $citaServicios;

    public function __construct()
    {
        $this->citaServicios = new ArrayCollection();
    }

    // Getters y setters
    public function getId(): ?int { return $this->id; }

    public function getCliente(): Cliente { return $this->cliente; }
    public function setCliente(Cliente $cliente): self { $this->cliente = $cliente; return $this; }

    public function getVehiculo(): Vehiculo { return $this->vehiculo; }
    public function setVehiculo(Vehiculo $vehiculo): self { $this->vehiculo = $vehiculo; return $this; }

    public function getFechaCita(): \DateTimeInterface { return $this->fechaCita; }
    public function setFechaCita(\DateTimeInterface $fechaCita): self { $this->fechaCita = $fechaCita; return $this; }

    public function getEstado(): EstadoCita { return $this->estado; }
    public function setEstado(EstadoCita $estado): self { $this->estado = $estado; return $this; }

    public function getObservaciones(): ?string { return $this->observaciones; }
    public function setObservaciones(?string $observaciones): self { $this->observaciones = $observaciones; return $this; }

    /**
     * @return Collection<int, CitaServicio>
     */
    public function getCitaServicios(): Collection
    {
        return $this->citaServicios;
    }

    public function addCitaServicio(CitaServicio $citaServicio): self
    {
        if (!$this->citaServicios->contains($citaServicio)) {
            $this->citaServicios[] = $citaServicio;
            $citaServicio->setCita($this);
        }

        return $this;
    }

    public function removeCitaServicio(CitaServicio $citaServicio): self
    {
        if ($this->citaServicios->removeElement($citaServicio)) {
            if ($citaServicio->getCita() === $this) {
                $citaServicio->setCita(null);
            }
        }

        return $this;
    }
        public function getEstadoLabel(): string
    {
        return $this->estado->label();
    }

}
