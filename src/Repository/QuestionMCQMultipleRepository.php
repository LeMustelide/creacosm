<?php

namespace App\Repository;

use App\Entity\QuestionMCQMultiple;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestionMCQMultiple>
 *
 * @method QuestionMCQMultiple|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionMCQMultiple|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionMCQMultiple[]    findAll()
 * @method QuestionMCQMultiple[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionMCQMultipleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionMCQMultiple::class);
    }

    public function save(QuestionMCQMultiple $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(QuestionMCQMultiple $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return QuestionMCQMultiple[] Returns an array of QuestionMCQMultiple objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('q.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?QuestionMCQMultiple
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
