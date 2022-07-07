<?php

namespace App\Repository;

use App\Entity\FinalUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FinalUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method FinalUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method FinalUser[]    findAll()
 * @method FinalUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FinalUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FinalUser::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(FinalUser $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(FinalUser $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return FinalUser[] Returns an array of FinalUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FinalUser
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */

    public function FindUserNameLike(string $likeString)
    {
        $query = $this->createQueryBuilder('u')
        ->where('u.username LIKE :likeString')
        ->setParameter('likeString' , '%'.$likeString.'%')->getQuery();
 
        return $query->getResult();
    }
}
