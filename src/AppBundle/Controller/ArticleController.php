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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Repository\ArticleRepository;
use AppBundle\Entity\Article;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Doctrine\ORM\EntityManagerInterface;
use AppBundle\Repository\SectionRepository;
use AppBundle\Repository\MediaRepository;
use AppBundle\Repository\CategoryRepository;

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
     * @var ParamFetcherInterface
     */
    private $paramFetcher;

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
        ParamFetcherInterface $paramFetcher,
        EntityManagerInterface $em,
        SectionRepository $sectionRepository,
        MediaRepository $mediaRepository,
        CategoryRepository $categoryRepository
        )
    {
        $this->repository = $articleRepository;
        $this->sectionRepository = $sectionRepository;
        $this->mediaRepository = $mediaRepository;
        $this->categoryRepository = $categoryRepository;
        $this->paramFetcher = $paramFetcher;
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
            return new JsonResponse(['message' => 'article.not.found'], Response::HTTP_NOT_FOUND);
        }
        return ['data' => $article];
    }
    
    /**
     * @ParamConverter("article", converter="fos_rest.request_body")
     * @Rest\View
     */
    public function postAction(Article $article, ConstraintViolationListInterface $validationErrors) {
        $mappingError = $this->relationMapper($article)['error'];
        if ($mappingError !== false) {
                return new JsonResponse([
                    'message' => $mappingError,
                ], 
                Response::HTTP_FORBIDDEN
            );
        }

        if (count($validationErrors) > 0) {
            return new JsonResponse([
                    'message' => $validationErrors[0]->getMessage(),
                    'field' => $validationErrors[0]->getPropertyPath()
                ], 
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if ($article->getPublished() !== null) {
            return new JsonResponse([
                    'message' => 'not.allowed.to.publish',
                ], 
                Response::HTTP_FORBIDDEN
            );
        }

        $this->em->persist($article);
        $this->em->flush();
    }

    /**
     * @param int $id
     * @Rest\View
     */
    public function deleteAction($id) {
        $article = $this->repository->findById($id);
        if ($article->getPublished() !== null) {
            return new JsonResponse([
                    'message' => 'not.allowed.to.remove',
                ],
                Response::HTTP_FORBIDDEN
            );
        }
        $this->em->remove($article);
        $this->em->flush();
    }

    /**
     * @ParamConverter("article", converter="fos_rest.request_body")
     * @param int $id
     * @Rest\View
     */
    public function patchAction(Article $article, ConstraintViolationListInterface $validationErrors, $id) {
        $articleModified = $this->repository->findById($id);
        
        if (!$articleModified) {
            return new JsonResponse(['message' => 'article.not.found'], Response::HTTP_NOT_FOUND);
        }
        
        if (count($validationErrors) > 0) {
            return new JsonResponse([
                    'message' => $validationErrors[0]->getMessage(),
                    'field' => $validationErrors[0]->getPropertyPath()
                ], 
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }

        if ($articleModified->getPublished() !== null) {
            return new JsonResponse([
                    'message' => 'not.allowed.to.modify',
                ], 
                Response::HTTP_FORBIDDEN
            );
        }

        if ($article->getPublished() !== null) {
            return new JsonResponse([
                    'message' => 'not.allowed.to.publish',
                ], 
                Response::HTTP_FORBIDDEN
            );
        }

        $message = $this->articleUpdater($article, $articleModified);
        if (array_key_exists('error', $message)) {
                return new JsonResponse([
                    'message' => $message['error'],
                ],
                Response::HTTP_FORBIDDEN
            );
        } else {
            return $message;
        }
    }

    private function articleUpdater(Article $articleRequested, Article $articleModified)
    {
        $editedField = [];

        $mappingError = $this->relationMapper($articleRequested);
        if ($mappingError['error'] !== false) {
            return $mappingError;
        }

        if ($articleRequested->getTitle() !== $articleModified->getTitle()) {
            $articleModified->setTitle($articleRequested->getTitle());
            $editedField[] = ['title'=>'updated.successfully'];
        }

        if ($articleRequested->getIntroduction() !== $articleModified->getIntroduction()) {
            $articleModified->setIntroduction($articleRequested->getIntroduction());
            $editedField[] = ['introduction'=>'updated.successfully'];
        }

        if ($articleRequested->getContent() !== $articleModified->getContent()) {
            $articleModified->setContent($articleRequested->getContent());
            $editedField[] = ['content'=>'updated.successfully'];
        }

        if ($articleRequested->getSection() !== $articleModified->getSection()) {
            $articleModified->setSection($articleRequested->getSection());
            $editedField[] = ['section'=>'updated.successfully'];
        }

        if ($articleRequested->getBackground() !== $articleModified->getBackground()) {
            $articleModified->setBackground($articleRequested->getBackground());
            $editedField[] = ['background'=>'updated.successfully'];
        }

        if ($articleRequested->getCategory() !== $articleModified->getCategory()) {
            $articleModified->setCategory($articleRequested->getCategory());
            $editedField[] = ['category'=>'updated.successfully'];
        }

        $this->em->remove($articleRequested);
        $this->em->persist($articleModified);
        $this->em->flush();

        return $editedField;
    }

    /**
     * Check if sub entity posted by client exist if yes they map sub entity to the article
     * @param Article $article
     * return Array
     */
    private function relationMapper($article) 
    {
        $error = [];
        if ($article->getSection()) {
            $section = $this->sectionRepository->find($article->getSection()->getId());
            if ($section) {
                $article->setSection($section);
            } else {
                $error = ['error' => 'unexpected.or.not.found.section'];
            }
        }

        if ($article->getBackground()) {
            $media = $this->mediaRepository->find($article->getBackground()->getId());
            if ($media) {
                $article->setBackground($media);
            } else {
                $error = ['error' => 'unexpected.or.not.found.background'];
            }
        }

        if ($article->getCategory()) {
            $category = $this->categoryRepository->find($article->getCategory()->getId());
            if ($category) {
                $article->setCategory($category);
            } else {
                $error = ['error' => 'unexpected.or.not.found.category'];
            }
        }

        if (!array_key_exists('error', $error)) {
            $this->em->persist($article);
            $error = ['error' => false];
        }

        return $error;
    }
}
