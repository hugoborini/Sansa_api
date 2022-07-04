<?php

namespace App\Repository;

use App\Entity\Services;
use App\Entity\Organization;
use Doctrine\ORM\ORMException;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @method Organization|null find($id, $lockMode = null, $lockVersion = null)
 * @method Organization|null findOneBy(array $criteria, array $orderBy = null)
 * @method Organization[]    findAll()
 * @method Organization[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganizationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Organization::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(Organization $entity, bool $flush = true): void
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
    public function remove(Organization $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return Organization[] Returns an array of Organization objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Organization
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findAllService(string $service): array
    {

        $serviceTab = unserialize($service);
        
        $sqlString = "";

        $numItems = count($serviceTab);
        $i = 0;
        
        foreach ($serviceTab as $service) {
            if(++$i === $numItems) {
                $sqlString = $sqlString . "s.service_name = '{$service}';";
            }else{
                
                $sqlString = $sqlString . "s.service_name = '{$service}' OR ";
            }
        }
        
        $conn = $this->getEntityManager()->getConnection();
        
        $sql = '
            SELECT DISTINCT organization.id 
            from organization JOIN services 
            as s ON s.organization_id_id = organization.id 
            WHERE ' . $sqlString;

        $stmt = $conn->prepare($sql);
        $allId =  $stmt->execute()->fetchAll();
        $allIdTab = [];

        foreach ($allId as $key => $id) {
            array_push($allIdTab, intval($id["id"]));  
        }

        return $allIdTab;
    }
}
