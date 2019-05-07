<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use Doctrine\Common\Collections\ArrayCollection;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Query;
use AppBundle\Repository\ActivityRepository;
use AppBundle\Repository\ContentRepository;
use AppBundle\Representation\Activities;
use AppBundle\Representation\Contents;

/**
 * Content Controller
 * @Rest\RouteResource("Content")
 */
class ContentController extends Controller
{

    /**
     * @var ContentRepository $repository
     */
    private $repository;

    /**
     * @var ActivityRepository $activityRepository
     */
    private $activityRepository;

    /**
     * @var ParamFetcherInterface
     */
    private $paramFetcher;

    public function __construct(
        ContentRepository $ContentRepository,
        ActivityRepository $activityRepository,
        ParamFetcherInterface $paramFetcher
    ) {
        $this->repository = $ContentRepository;
        $this->activityRepository = $activityRepository;
        $this->paramFetcher = $paramFetcher;
    }

    /**
     * @Rest\View(serializerGroups={"Content:list", "Section:list"})
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
            $this->paramFetcher->get('limit'),
            $this->paramFetcher->get('page')
        );
        return new Contents($pager);
    }

    /**
     * @Rest\View(serializerGroups={"Content:details", "Section:list"})
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
    public function getAction($id)
    {
        $data = $this->repository->find($id);
        foreach ($data->getContentBlocks() as $contentBlock) {
            $results = $this->findResults($contentBlock->getQuery());
            $contentBlock->setResults($results);
            $contentBlock->setPublicFilters($contentBlock->getQuery()->getPublicFilters());
        }
        if (!$data) {
            return new JsonResponse(['message' => 'Content not found'], Response::HTTP_NOT_FOUND);
        }
        return ['data' => $data];
    }

    /**
     * Find query's results
     *
     * @param Query $query
     * @return ArrayCollection
     */
    private function findResults($query)
    {

        switch ($query->getEntity()) {
            case 'activity':
                return $this->findActivities($query);
                break;
        }
    }
   
    /**
     * Find activities
     *
     * @param Query $query
     * @return ArrayCollection
     */
    private function findActivities($query)
    {
        $limit = $this->paramFetcher->get('limit');
        $page = $this->paramFetcher->get('page');
        $pager = $this->activityRepository->findResults(
            $query,
            Query::TYPE_AND,
            $limit,
            $page
        );
        return new Activities($pager);
    }
}
