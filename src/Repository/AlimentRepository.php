<?php

namespace App\Repository;

use App\Entity\Aliment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;


/**
 * @method Aliment|null find($id, $lockMode = null, $lockVersion = null)
 * @method Aliment|null findOneBy(array $criteria, array $orderBy = null)
 * @method Aliment[]    findAll()
 * @method Aliment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlimentRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Aliment::class);
    }

    /* Cette fonction sera excécuté par le controller AlimentController, en envoyant des parametres
    contenant la valeurs du parametre $calorie */
    /* elle permet de recuperer des aliment a partir de la base de données avec des critére, c'est a dire en precisant
    un where de la requete */ 

    public function   getAlimentParNbPropriete($propriete,$signe,$calorie){
        return $this->createQueryBuilder('a')
            ->andWhere('a.'.$propriete.' '.$signe.':val')
            ->setParameter('val', $calorie)
            ->getQuery()
            ->getResult()
        ;
    }
    // /**
    //  * @return Aliment[] Returns an array of Aliment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Aliment
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
