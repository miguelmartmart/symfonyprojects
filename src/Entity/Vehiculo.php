<?php

// src/Entity/Vehiculo.php

namespace App\Entity;

use App\Enum\VehiculoTipo;
use App\Repository\VehiculoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculoRepository::class)]
class Vehiculo
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Cliente::class, inversedBy: 'vehiculos')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Cliente $cliente = null;

    #[ORM\Column(type: 'string', length: 255, enumType: VehiculoTipo::class)]
    private VehiculoTipo $tipo;

    #[ORM\Column(type: 'string', length: 100)]
    private string $marca;

    #[ORM\Column(type: 'string', length: 100)]
    private string $modelo;

    #[ORM\Column(type: 'integer', nullable: true)]
    private ?int $anio = null;

    #[ORM\Column(type: 'string', length: 50, nullable: true)]
    private ?string $matricula = null;

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

    public function getTipo(): VehiculoTipo
    {
        return $this->tipo;
    }

    public function setTipo(VehiculoTipo $tipo): self
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function getMarca(): string
    {
        return $this->marca;
    }

    public function setMarca(string $marca): self
    {
        $this->marca = $marca;
        return $this;
    }

    public function getModelo(): string
    {
        return $this->modelo;
    }

    public function setModelo(string $modelo): self
    {
        $this->modelo = $modelo;
        return $this;
    }

    public function getAnio(): ?int
    {
        return $this->anio;
    }

    public function setAnio(?int $anio): self
    {
        $this->anio = $anio;
        return $this;
    }

    public function getMatricula(): ?string
    {
        return $this->matricula;
    }

    public function setMatricula(?string $matricula): self
    {
        $this->matricula = $matricula;
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
