<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Representation\Categories;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Representation\Articles;

/**
 * Category Controller
 * @Rest\RouteResource("Category")
 */
class CategoryController extends Controller
{

    /**
     * @var CategoryRepository $repository
     */
    private $repository;

    /**
     * @var ParamFetcherInterface
     */
    private $paramFetcher;

    /**
     * @var ArticleRepository
     */
    private $articleRepository;

    public function __construct(
        CategoryRepository $categoryRepository,
        ParamFetcherInterface $paramFetcher,
        ArticleRepository $articleRepository
    ) {
        $this->repository = $categoryRepository;
        $this->paramFetcher = $paramFetcher;
        $this->articleRepository = $articleRepository;
    }

    /**
     * @Rest\View(serializerGroups={"Category:list", "Section:list"})
     *
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="50",
     *     description="Max number of items per page."
     * )
     * @Rest\QueryParam(
     *     name="page",
     *     requirements="\d+",
     *     default="1",
     *     description="The pagination page"
     * )
     *
     *  @return \FOS\RestBundle\View\View
     */
    public function cgetAction()
    {
        $pager = $this->repository->findPublished(
            true,
            $this->paramFetcher->get('limit'),
            $this->paramFetcher->get('page')
        );
        return new Categories($pager);
    }

    /**
     * @Rest\View(serializerGroups={"Category:details", "Section:list", "Article:list"})
     *
     * @param int $id
     * @return \FOS\RestBundle\View\View
     */
    public function getAction($id)
    {
        $category = $this->repository->find($id);

        if (!$category) {
            return new JsonResponse(['message' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }

        $articles = $this->articleRepository->findByCategory($category, false, 5);
        $category->setArticles($articles);
        
        return ['data' => $category];
    }

    /**
     * @Rest\View(serializerGroups={"Article:list"})
     *
     * @Rest\QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="50",
     *     description="Max number of items per page."
     * )
     * @Rest\QueryParam(
     *     name="page",
     *     requirements="\d+",
     *     default="1",
     *     description="The pagination page"
     * )
     *
     * @param int $id
     * @return \FOS\RestBundle\View\View
     */
    public function getArticlesAction($id)
    {

        $category = $this->repository->find($id);
        if (!$category) {
            return new JsonResponse(['message' => 'Category not found'], Response::HTTP_NOT_FOUND);
        }
        $pager = $this->articleRepository->findByCategory(
            $category,
            true,
            $this->paramFetcher->get('limit'),
            $this->paramFetcher->get('page')
        );

        return new Articles($pager);
    }
}
