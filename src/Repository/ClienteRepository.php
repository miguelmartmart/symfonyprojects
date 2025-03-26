<?php

namespace App\Repository;

use App\Entity\Cliente;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Cliente>
 *
 * @method Cliente|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cliente|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cliente[]    findAll()
 * @method Cliente[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClienteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cliente::class);
    }

    /**
     * Ejemplo de método personalizado: Buscar clientes por nombre parcial
     *
     * @param string $nombre
     * @return Cliente[]
     */
    public function buscarPorNombre(string $nombre): array
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.nombre LIKE :nombre')
            ->setParameter('nombre', '%' . $nombre . '%')
            ->orderBy('c.nombre', 'ASC')
            ->getQuery()
            ->getResult();
    }
}
