<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Repository;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Pagerfanta\Pagerfanta;
use AppBundle\Entity\Article;
use AppBundle\Entity\Category;
use AppBundle\Entity\Section;

class ArticleRepository extends AbstractRepository
{

    /**
     * @var EntityRepository
     */
    private $repository;
    
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->repository = $entityManager->getRepository(Article::class);
    }
    
    /**
     * Find articles by Id
     *
     * @param iteger $id
     * @return Null|Article
     */
    public function findById($id)
    {
        $qb = $this->repository->createQueryBuilder('a')
        ->select('a')
        ->where('a.id = :id')
        ->setParameters(['id' => $id]);

        return $qb->getQuery()->getOneOrNullResult();
    }

    /**
     * Find articles by Category
     *
     * @param Category $category
     * @param integer $limit
     * @param integer $page
     * @return Pagerfanta|ArrayCollection
     */
    public function findByCategory(Category $category, $paginated = false, $limit = 50, $page = 1)
    {
        $qb = $this->repository->createQueryBuilder('a')
        ->select('a')
        ->where('a.category = :category')
        ->setParameters(['category' => $category]);

        if ($paginated) {
            return $this->paginate($qb, $limit, $page);
        }

        $qb->setMaxResults($limit);
        return new ArrayCollection($qb->getQuery()->getResult());
    }

    /**
     * Find articles by Section
     *
     * @param Section $section
     * @param integer $limit
     * @param integer $page
     * @return Pagerfanta|ArrayCollection
     */
    public function findBySection(Section $section, $paginated = false, $limit = 50, $page = 1)
    {
        $qb = $this->repository->createQueryBuilder('a')
        ->select('a')
        ->where('a.section = :section')
        ->setParameters(['section' => $section]);

        if ($paginated) {
            return $this->paginate($qb, $limit, $page);
        }

        $qb->setMaxResults($limit);
        return new ArrayCollection($qb->getQuery()->getResult());
    }
}
