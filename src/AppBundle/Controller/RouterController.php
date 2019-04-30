<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;

/**
 * Router Controller
 */
class RouterController extends Controller
{
    /**
     * Default router action, called by Cmf's Dynamic Router
     *
     * @param Category|Section|Content $contentDocument
     * @return void
     */
    public function defaultAction($contentDocument)
    {
        $serializer = SerializerBuilder::create()->build();
        $serializerContext = SerializationContext::create()->setGroups([$contentDocument->getClassName().':details']);
        $jsonContent = $serializer->serialize($contentDocument, 'json', $serializerContext);
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'content' => $contentDocument,
            'jsonContent' => $jsonContent
        ]);
    }
}
