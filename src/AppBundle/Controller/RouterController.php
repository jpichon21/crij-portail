<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
            'content' => $contentDocument
        ]);
    }
}
