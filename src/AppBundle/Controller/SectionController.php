<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\RouteResource;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Representation\Categories;
use AppBundle\Repository\SectionRepository;

/**
 * Section Controller
 * @RouteResource("Section")
 */
class SectionController extends Controller
{

    /**
     * @var SectionRepository $repository
     */
    private $repository;

    /**
     * @var ParamFetcherInterface
     */
    private $paramFetcher;

    public function __construct(SectionRepository $sectionRepository, ParamFetcherInterface $paramFetcher)
    {
        $this->repository = $sectionRepository;
        $this->paramFetcher = $paramFetcher;
    }

    /**
     * @View(serializerGroups={"Section:list", "Section:list"})
     *
     * @QueryParam(
     *     name="limit",
     *     requirements="\d+",
     *     default="50",
     *     description="Max number of items per page."
     * )
     * @QueryParam(
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
        return new Categories($pager);
    }

    /**
     * @View(serializerGroups={"Section:details", "Section:list"})
     *
     * @param int $id
     * @return \FOS\RestBundle\View\View
     */
    public function getAction($id)
    {
        $data = $this->repository->find($id);

        if (!$data) {
            return new JsonResponse(['message' => 'Section not found'], Response::HTTP_NOT_FOUND);
        }
        return ['data' => $data];
    }
}
