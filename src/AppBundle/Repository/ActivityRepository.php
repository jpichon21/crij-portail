<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Activity;
use Pagerfanta\Pagerfanta;
use AppBundle\Entity\QueryFilter;
use Doctrine\ORM\QueryBuilder;
use AppBundle\Entity\Query;

class ActivityRepository extends AbstractRepository
{

    /**
     * @var EntityRepository
     */
    private $repository;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Activity::class);
    }

    /**
     * Find published contents
     *
     * @param Query $query
     * @param string $type
     * @param integer $limit
     * @param integer $page
     * @return Pagerfanta
     */
    public function findResults($query, $type, $limit = 10, $page = 1)
    {
        $qb = $this->repository->createQueryBuilder('a')
        ->select('a');
        foreach ($query->getFilters() as $filter) {
            $qb = $this->addFilter($qb, $filter, $type);
        }
        return $this->paginate($qb, $limit, $page);
    }


    /**
     * Add a filter to the querybuilder
     *
     * @param QueryBuilder $qb
     * @param array $filter
     * @param string $type
     * @return QueryBuilder
     */
    private function addFilter($qb, $filter, $type)
    {
        
        if ($type === QueryFilter::TYPE_AND) {
            $qb->andWhere('a.' . $filter->getField() . '=' . ':' . $filter->getField());
            $qb->setParameter(':'.$filter->getField(), $filter->getValue());
        }
        return $qb;
    }

    /**
     * Find Activity by id
     *
     * @param int $id
     * @return Activity
     */
    public function find($id)
    {
        $qb = $this->repository->createQueryBuilder('c')
        ->select('c')
        ->where('c.id = :id')
        ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }
}
