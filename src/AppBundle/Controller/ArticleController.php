<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Article;
use AppBundle\Form\ArticleType;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Repository\CategoryRepository;
use AppBundle\Repository\MediaRepository;
use AppBundle\Repository\SectionRepository;

/**
 * Article Controller
 * @Rest\RouteResource("Article")
 */
class ArticleController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    
    /**
     * @var ArticleRepository $repository
     */
    private $repository;

    /**
     * @var SectionRepository
     */
    private $sectionRepository;

    /**
     * @var MediaRepository
     */
    private $mediaRepository;

    /**
     * @var CategoryRepository
     */
    private $categoryRepository;

    public function __construct(
        ArticleRepository $articleRepository,
        EntityManagerInterface $em,
        SectionRepository $sectionRepository,
        MediaRepository $mediaRepository,
        CategoryRepository $categoryRepository
    ) {
        $this->repository = $articleRepository;
        $this->sectionRepository = $sectionRepository;
        $this->mediaRepository = $mediaRepository;
        $this->categoryRepository = $categoryRepository;
        $this->em = $em;
    }

    /**
     * @Rest\View(serializerGroups={"Article:details"})
     * @return \FOS\RestBundle\View\View
     */
    public function getAction($id)
    {
        $article = $this->repository->findById($id);
        if (!$article) {
            return new JsonResponse(['message' => 'error.article_not_found'], Response::HTTP_NOT_FOUND);
        }
        return ['data' => $article];
    }
    
    /**
     * @Rest\View
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request)
    {
        return $this->createOrEdit($request);
    }

     /**
     * @param int $id
     * @Rest\View
     * @Security("has_role('ROLE_USER')")
     */
    public function patchAction($id, Request $request)
    {
        return $this->createOrEdit($request, $id);
    }

    /**
     * @param int $id
     * @Rest\View
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteAction($id)
    {
        $article = $this->repository->findById($id);

        if (!$article) {
            return new JsonResponse(['message' => 'error.article_not_found'], Response::HTTP_NOT_FOUND);
        }

        if ($article->getPublished()) {
            return new JsonResponse(['message' => 'error.article_published'], Response::HTTP_FORBIDDEN);
        }

        if ($article->getAuthor() !== $this->getUser()) {
            return new JsonResponse(
                ['message' => 'error.not_allowed_to_update_this_resource'],
                Response::HTTP_FORBIDDEN
            );
        }
        $this->em->remove($article);
        $this->em->flush();
    }

    private function createOrEdit(Request $request, $id = null)
    {
        if ($id) {
            $article = $this->repository->findById($id);
        
            if (!$article) {
                return new JsonResponse(['message' => 'error.article_not_found'], Response::HTTP_NOT_FOUND);
            }
            
            if ($article->getAuthor() !== $this->getUser()) {
                return new JsonResponse(
                    ['message' => 'error.not_allowed_to_update_this_resource'],
                    Response::HTTP_FORBIDDEN
                );
            }

            if ($article->getPublished()) {
                return new JsonResponse(['message' => 'error.article_published'], Response::HTTP_FORBIDDEN);
            }
        } else {
            $article = new Article();
            $article->setAuthor($this->getUser());
        }
        
        $section = null;
        if ($request->request->has('section')) {
            $section = $this->sectionRepository->find($request->request->get('section'));
            if (!$section) {
                return new JsonResponse(['message' => 'error.section_not_found'], Response::HTTP_NOT_FOUND);
            }
        }
        
        $category = null;
        if ($request->request->has('category')) {
            $category = $this->categoryRepository->find($request->request->get('category'));
            if (!$category) {
                return new JsonResponse(['message' => 'error.category_not_found'], Response::HTTP_NOT_FOUND);
            }
        }

        $background = null;
        if ($request->request->has('background')) {
            $background = $this->mediaRepository->find($request->request->get('background'));
            if (!$background) {
                return new JsonResponse(['message' => 'error.background_not_found'], Response::HTTP_NOT_FOUND);
            }
        }

        $form = $this->createForm(ArticleType::class, $article);

        // Remove linked entities from request's body, we will set them after
        $formParams = $request->request->all();
        unset($formParams['section']);
        unset($formParams['category']);
        unset($formParams['background']);
        $form->submit($formParams, true);

        if ($form->isValid()) {
            if ($section) {
                $article->setSection($section);
            }
            if ($category) {
                $article->setCategory($category);
            }
            if ($background) {
                $article->setBackground($background);
            }
            $this->em->persist($article);
            $this->em->flush();
            return ['data' => $article];
        } else {
            $invalidParams = [];
            foreach ($form->getErrors(true) as $error) {
                $invalidParams[] = ['error' => $error->getMessage(), 'field' => $error->getCause()->getPropertyPath()];
            }
            return new JsonResponse(
                [
                    'message' => 'error.validation_error',
                    'invalidParams' => $invalidParams
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
