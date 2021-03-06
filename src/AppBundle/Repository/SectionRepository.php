<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use AppBundle\Entity\Section;
use Pagerfanta\Pagerfanta;

class SectionRepository extends AbstractRepository
{

    /**
     * @var EntityRepository
     */
    private $repository;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Section::class);
    }

    /**
     * Find published sections
     *
     * @param integer $limit
     * @param integer $page
     * @return Pagerfanta
     */
    public function findPublished($limit = 50, $page = 1)
    {
        $qb = $this->repository->createQueryBuilder('s')
        ->select('s')
        ->where('s.published = 1');
        return $this->paginate($qb, $limit, $page);
    }

    /**
     * Find section by id (only if it is published)
     *
     * @param int $id
     * @return Section
     */
    public function find($id)
    {
        $qb = $this->repository->createQueryBuilder('s')
        ->select('s')
        ->where('s.published = 1')
        ->andWhere('s.id = :id')
        ->setParameter('id', $id);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Find section's articles
     *
     * @param integer $id
     * @param integer $limit
     * @param integer $page
     * @return Pagerfanta
     */
    public function findArticles($id, $limit = 50, $page = 1)
    {
        $qb = $this->repository->createQueryBuilder('s')
        ->select('s')
        ->where('s.published = 1')
        ->andWhere('s.id = :id')
        ->setParameter('id', $id);
        return $this->paginate($qb, $limit, $page);
    }
}
