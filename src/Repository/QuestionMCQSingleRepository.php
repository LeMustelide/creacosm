<?php

namespace App\Repository;

use App\Entity\QuestionMCQSingle;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<QuestionMCQSingle>
 *
 * @method QuestionMCQSingle|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuestionMCQSingle|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuestionMCQSingle[]    findAll()
 * @method QuestionMCQSingle[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuestionMCQSingleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuestionMCQSingle::class);
    }

    public function save(QuestionMCQSingle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(QuestionMCQSingle $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return QuestionMCQSingle[] Returns an array of QuestionMCQSingle objects
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

//    public function findOneBySomeField($value): ?QuestionMCQSingle
//    {
//        return $this->createQueryBuilder('q')
//            ->andWhere('q.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
