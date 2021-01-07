<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method User|null find($id, $lockMode = null, $lockVersion = null)
 * @method User|null findOneBy(array $criteria, array $orderBy = null)
 * @method User[]    findAll()
 * @method User[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, User::class);
    }

    /**
    * @return Product[]
    */
    public function findByClicsOrdyByDESC(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\User p
            ORDER BY p.clics DESC'
        );

        // returns an array of Product objects
        return $query->setMaxResults(10)
                    ->getResult();
    }

    /**
    * @return Product[]
    */
    public function deleteMoreThan10(): array
    {
        //SELECT * FROM `user`WHERE `id` NOT IN (SELECT * FROM (SELECT `id` FROM `user` ORDER BY `clics` DESC LIMIT 10) AS temp)
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
            'SELECT p
            FROM App\Entity\User p
            ORDER BY p.clics ASC'
        );

        $count = $entityManager->createQuery(
            'SELECT COUNT(u) FROM App\Entity\User u'
        )->getResult();

        return $query->setMaxResults($count[0][1]-10)
                    ->getResult();
    }

    // /**
    //  * @return User[] Returns an array of User objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?User
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
