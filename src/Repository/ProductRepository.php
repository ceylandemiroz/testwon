<?php

namespace App\Repository;

use App\Classe\Search;
use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product|null findOneBySlug(array $slug, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    /**
     * Requete qui permet de récuperer les produits en fonction de la recherche
     * @return Product[]
     */
    public function findWithSearch(Search $search)
    {
        //quelle table de faire mapping 
        //product 'p' category 'c'

       $query = $this
       ->createQueryBuilder('p')
       ->select('c', 'p')
       ->join('p.category', 'c');
       if (!empty($search->categories)) {
           $query = $query
           ->andWhere('c.id IN (:categories)')
           ->setParameter('categories', $search->categories);
           
       }
       if(!empty($search->string)){
           $query = $query
           ->andWhere('p.name LIKE :string')
           ->setParameter('categories', "%{$search->string}%");
       }
       return $query
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Product
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
