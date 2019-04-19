<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */
namespace AppBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Pagerfanta\Adapter\DoctrineORMAdapter;
use Pagerfanta\Pagerfanta;

/**
 * AbstractRepository
 */
abstract class AbstractRepository
{
    protected function paginate(QueryBuilder $qb, $limit = 50, $page = 1)
    {
        if (0 === $limit || $page === 0) {
            throw new \LogicException('$limit and $page must be greater than 0.');
        }
        
        $pager = new Pagerfanta(new DoctrineORMAdapter($qb));
        $pager->setMaxPerPage($limit);
        $pager->setCurrentPage($page);
        
        return $pager;
    }
}
