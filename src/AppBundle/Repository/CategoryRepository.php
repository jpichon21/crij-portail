<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Category;
use Pagerfanta\Pagerfanta;

class CategoryRepository extends AbstractRepository
{

    /**
     * @var EntityRepository
     */
    private $repository;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Category::class);
    }

    /**
     * Find published categories
     *
     * @param integer $limit
     * @param integer $page
     * @return Pagerfanta
     */
    public function findPublished($paginated = false, $limit = 50, $page = 1)
    {
        $qb = $this->repository->createQueryBuilder('c')
        ->select('c')
        ->where('c.published = 1');
        if ($paginated) {
            return $this->paginate($qb, $limit, $page);
        }
        return $qb->getQuery()->getResult();
    }

    /**
     * Find category by id (only if it is published)
     *
     * @param int $id
     * @return Category
     */
    public function find($id)
    {
        $qb = $this->repository->createQueryBuilder('c')
        ->select('c')
        ->where('c.published = 1')
        ->andWhere('c.id = :id')
        ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
