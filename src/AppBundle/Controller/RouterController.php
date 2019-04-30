<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\SerializationContext;
use AppBundle\Repository\CategoryRepository;

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
        $serializerGroups = $this->setSerializerGroups($contentDocument->getClassName());

        $jsonContent = $serializer->serialize($contentDocument, 'json', SerializationContext::create()->setGroups($serializerGroups));

        return $this->render('default/index.html.twig', [
            'content' => $contentDocument,
            'jsonContent' => $jsonContent,
            'contentClassName' => $contentDocument->getClassName()
        ]);
    }

    /**
     * @param string $className
     * @return array
     */
    private function setSerializerGroups($className)
    {
        switch ($className) {
            case 'Category':
                return ['Category:details', 'Section:list'];
            case 'Section':
                return ['Category:list', 'Section:details', 'Content:list'];
            case 'Content':
                return ['Category:list', 'Section:list', 'Content:details'];
        }
    }
}
