<?php

namespace App\Entity;

use App\Repository\CitaEmpleadoRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CitaEmpleadoRepository::class)]
#[ORM\Table(name: 'cita_empleados')]
class CitaEmpleado
{
    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Cita::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Cita $cita;

    #[ORM\Id]
    #[ORM\ManyToOne(targetEntity: Empleado::class)]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    private Empleado $empleado;

    public function getCita(): Cita
    {
        return $this->cita;
    }

    public function setCita(Cita $cita): self
    {
        $this->cita = $cita;
        return $this;
    }

    public function getEmpleado(): Empleado
    {
        return $this->empleado;
    }

    public function setEmpleado(Empleado $empleado): self
    {
        $this->empleado = $empleado;
        return $this;
    }
}
