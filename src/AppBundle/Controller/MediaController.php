<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Stof\DoctrineExtensionsBundle\Uploadable\UploadableManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Media;
use AppBundle\Repository\MediaRepository;

/**
 * Media Controller
 * @Rest\RouteResource("Media")
 */
class MediaController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    
    /**
     * @var MediaRepository $repository
     */
    private $repository;

    /**
     * @var UploadableManager $uploadableManager
     */
    private $uploadableManager;

    public function __construct(
        MediaRepository $repository,
        EntityManagerInterface $em,
        UploadableManager $uploadableManager
    ) {
        $this->repository = $repository;
        $this->em = $em;
        $this->uploadableManager = $uploadableManager;
    }

    /**
     * @param Request $request
     *
     * @Rest\View
     * @Security("has_role('ROLE_USER')")
     */
    public function postAction(Request $request)
    {
        $media = new Media();
        $form = $this->createFormBuilder($media)
        ->add('title')
        ->getForm();
        
        if (!$request->request->has('title')) {
            return new JsonResponse(['message' => 'error.must_provide_a_title'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        if (!$request->files->has('file')) {
            return new JsonResponse(['message' => 'error.must_provide_a_file'], Response::HTTP_UNPROCESSABLE_ENTITY);
        }
        $file = $request->files->get('file');
        $form->submit($request->request->all());
        
        if ($form->isSubmitted()) {
            $this->em->persist($media);
            $media->setFile($file);
            $this->uploadableManager->markEntityToUpload($media, $media->getFile());
            
            $media->setAuthor($this->getUser());
            $this->em->flush();
            return $media;
        }
    }

    /**
     * @param int $id
     * @Rest\View
     * @Security("has_role('ROLE_USER')")
     */
    public function deleteAction($id)
    {
        $media = $this->repository->findById($id);
        if (!$media) {
            return new JsonResponse(['message' => 'error.media_not_found'], Response::HTTP_NOT_FOUND);
        }
        if ($media->getAuthor() !== $this->getUser()) {
            return new JsonResponse(
                ['message' => 'error.not_allowed_to_delete_this_resource'],
                Response::HTTP_UNAUTHORIZED
            );
        }
        $this->em->remove($media);
        $this->em->flush();
    }
}
