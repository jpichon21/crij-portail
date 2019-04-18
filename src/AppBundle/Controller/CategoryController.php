<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use AppBundle\Entity\Category;
use AppBundle\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations\QueryParam;

/**
 * Category Controller
 * @RouteResource("Category")
 */
class CategoryController extends Controller
{

    /**
     * @var CategoryRepository $categoryRepository
     */
    private $repository;

    /**
     * @var ParamFetcherInterface
     */
    private $paramFetcher;

    public function __construct(CategoryRepository $categoryRepository, ParamFetcherInterface $paramFetcher)
    {
        $this->repository = $categoryRepository;
        $this->paramFetcher = $paramFetcher;
    }
    /**
     * Default router action, called by Cmf's Dynamic Router
     *
     * @return Category[]|ArrayCollection
     *
     * @QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="40",
     *     description="Max number of items per page."
     * )
     * @QueryParam(
     *     name="offset",
     *     requirements="\d+",
     *     default="0",
     *     description="The pagination offset"
     * )
     */
    public function cgetAction()
    {
        return $this->repository->findPublic(
            $this->paramFetcher->get('limit'),
            $this->paramFetcher->get('offset')
        );
    }

    public function getAction($id)
    {
        
    }

}
