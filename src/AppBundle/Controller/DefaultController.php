<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use AppBundle\Repository\CategoryRepository;

/**
 * Default Controller
 */
class DefaultController extends Controller
{
    /**
     * Default homepage
     *
     *  @Route("/")
     * @return void
     */
    public function indexAction(CategoryRepository $categoryRepository)
    {
        $serializer = SerializerBuilder::create()->build();
        $categories = $categoryRepository->findPublished();
        $jsonCategories = $serializer->serialize(
            $categories,
            'json',
            SerializationContext::create()->setGroups(['Category:details'])
        );
        
        $jsonConfig = $serializer->serialize($this->getParameter('site_config'), 'json');

        return $this->render('default/index.html.twig', [
            'jsonCategories' => $jsonCategories,
            'jsonConfig' => $jsonConfig
        ]);
    }

    /**
     * @Route("/api/config")
     */
    public function getConfigAction()
    {
        return $this->json(['data' => $this->getParameter('site_config')]);
    }
}
