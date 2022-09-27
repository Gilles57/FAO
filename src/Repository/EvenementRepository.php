<?php

namespace App\Repository;

use App\Entity\Evenement;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Evenement|null find($id, $lockMode = null, $lockVersion = null)
 * @method Evenement|null findOneBy(array $criteria, array $orderBy = null)
 * @method Evenement[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EvenementRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Evenement::class);
    }

    public function findOneById(int $villeId)
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e, v
            FROM App\Entity\Evenement e
            INNER JOIN e.ville v
            WHERE e.id = :id'
        )->setParameter('id', $villeId);

        return $query->getOneOrNullResult();
    }

    /**
     * @param $now
     *
     * @return array Returns an array of Evenement objects
     */
    public function findAllInFuture($now): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e, v
            FROM App\Entity\Evenement e
            INNER JOIN e.ville v
            Where (e.beginAt >= :date or e.endAt >= :date)
            '
        )->setParameter('date', $now);

        return $query->getArrayResult();
    }

    /**
     * @return array Returns an array of Evenement objects
     */
    public function findAllWithBeginDefined(): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.beginAt IS NOT NULL')
            ->orderBy('p.beginAt', 'ASC')
            ->getQuery()
            ->getResult();
    }

    /**
     * @return array Returns an array of Evenement objects
     */
    public function findAll(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e, v, r
            FROM App\Entity\Evenement e
            INNER JOIN e.ville v
            INNER JOIN e.rubrique r
            '
        );

        return $query->getArrayResult();
    }

}
