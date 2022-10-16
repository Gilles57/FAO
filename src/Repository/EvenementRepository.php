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

    public function findOneById(int $villeId): Evenement
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
     * @param $yesterday
     *
     * @return array Returns an array of Evenement objects
     */
    public function findAllInFuture(\DateTimeImmutable $yesterday): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT e, v, r
            FROM App\Entity\Evenement e
            INNER JOIN e.ville v
            INNER JOIN e.rubrique r
            WHERE (e.beginAt >= :date or e.endAt >= :date)
            ORDER BY e.beginAt ASC
            '
        )->setParameter('date', $yesterday);
        return $query->getArrayResult();
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
