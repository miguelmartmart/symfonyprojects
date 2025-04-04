<?php

namespace App\Entity;

use App\Repository\ClienteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClienteRepository::class)]
#[ORM\Table(name: 'cliente')]
class Cliente
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private string $nombre;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $telefono = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $email = null;

    #[ORM\Column(length: 500, nullable: true)]
    private ?string $direccion = null;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $createdAt;

    #[ORM\Column(type: 'datetime')]
    private \DateTimeInterface $updatedAt;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: Vehiculo::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $vehiculos;

    #[ORM\OneToMany(mappedBy: 'cliente', targetEntity: Cita::class, cascade: ['persist'], orphanRemoval: true)]
    private Collection $citas;

    public function __construct()
    {
        $this->vehiculos = new ArrayCollection();
        $this->citas = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->updatedAt = new \DateTimeImmutable();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(?string $telefono): self
    {
        $this->telefono = $telefono;
        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(?string $email): self
    {
        $this->email = $email;
        return $this;
    }

    public function getDireccion(): ?string
    {
        return $this->direccion;
    }

    public function setDireccion(?string $direccion): self
    {
        $this->direccion = $direccion;
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

    public function getVehiculos(): Collection
    {
        return $this->vehiculos;
    }

    public function addVehiculo(Vehiculo $vehiculo): self
    {
        if (!$this->vehiculos->contains($vehiculo)) {
            $this->vehiculos[] = $vehiculo;
            $vehiculo->setCliente($this);
        }
        return $this;
    }

    public function removeVehiculo(Vehiculo $vehiculo): self
    {
        if ($this->vehiculos->removeElement($vehiculo)) {
            if ($vehiculo->getCliente() === $this) {
                $vehiculo->setCliente(null);
            }
        }
        return $this;
    }

    public function getCitas(): Collection
    {
        return $this->citas;
    }

    public function addCita(Cita $cita): self
    {
        if (!$this->citas->contains($cita)) {
            $this->citas[] = $cita;
            $cita->setCliente($this);
        }
        return $this;
    }

    public function removeCita(Cita $cita): self
    {
        if ($this->citas->removeElement($cita)) {
            if ($cita->getCliente() === $this) {
                $cita->setCliente(null);
            }
        }
        return $this;
    }
}
