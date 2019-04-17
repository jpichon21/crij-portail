<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Service;

use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\Route;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\ContentRepository;
use Symfony\Cmf\Bundle\RoutingBundle\Doctrine\Orm\RouteProvider;
use Symfony\Cmf\Component\Routing\RouteObjectInterface;
use AppBundle\Entity\Category;
use AppBundle\Entity\Section;
use AppBundle\Entity\Content;
use Symfony\Cmf\Bundle\RoutingBundle\Routing\DynamicRouter;

class ContentService
{

    /**
     * @var RouteProvider
     */
    private $routeProvider;

    /**
     * @var ContentRepository
     */
    private $contentRepository;

    /**
     * @var DynamicRouter
     */
    private $dynamicRouter;

    /**
     * Constructor
     *
     * @param RouteProvider $routeProvider
     * @param ContentRepository $contentRepository
     */
    public function __construct(
        RouteProvider $routeProvider,
        ContentRepository $contentRepository,
        DynamicRouter $dynamicRouter
    ) {
        $this->routeProvider = $routeProvider;
        $this->contentRepository = $contentRepository;
        $this->dynamicRouter = $dynamicRouter;
    }

    /**
     * Set content's route
     *
     * @param Category|Section|Content $content
     * @return Category|Section|Content
     */
    public function setContentRoute($content)
    {
        if (count($content->getRoutes()) === 0) {
            return $this->addContentRoute($content);
        }
        return $this->updateContentRoute($content);
    }

    /**
     * Add content's route
     *
     * @param Category|Section|Content $content
     * @return Category|Section|Content
     */
    private function addContentRoute($content)
    {
        if ($content instanceof Content) {
            if ($content->getSection() === null) {
                return $content;
            }
        }
        if ($content instanceof Section) {
            if ($content->getCategory() === null) {
                return $content;
            }
        }
        $route = new Route();
        $route->setHost($this->getHostFromContent($content));
        $routeName = $this->routeNameFromContent($content);
        $url = $this->routeUrlFromContent($content);
        if (!$this->isRouteNameAvailable($routeName)) {
            $url = $this->addSuffix($url);
            $routeName = $this->addSuffix($routeName);
        }
        $route->setName($routeName);
        $route->setStaticPrefix($url);
        $route->setDefault(
            RouteObjectInterface::CONTENT_ID,
            $this->contentRepository->getContentId($content)
        );
        $route->setContent($content);
        $content->addRoute($route);
        return $content;
    }

    /**
     * Update content's route
     *
     * @param Category|Section|Content $content
     * @return Category|Section|Content
     */
    private function updateContentRoute($content)
    {
        $oldName = $content->getRoutes()[0]->getName();
        $newName = $this->routeNameFromContent($content);
        if ($oldName !== $newName) {
            $routes = $content->getRoutes();
            foreach ($routes as $key => $route) {
                $route->setHost($this->getHostFromContent($content));
                $url = $this->routeUrlFromContent($content);
                if (!$this->isRouteNameAvailable($newName)) {
                    $url = $this->addSuffix($url);
                    $newName = $this->addSuffix($newName);
                }
                $route->setName($newName);
                $route->setStaticPrefix($url);
                $routes[$key] = $route;
            }
        }
        return $content;
    }

    /**
     * Get content's host
     *
     * @param Category|Section|Content $content
     * @return string|null
     */
    private function getHostFromContent($content)
    {
        if ($content instanceof Content) {
            $content = $content->getSection();
        }
        if ($content instanceof Section) {
            $content = $content->getCategory();
        }
        return $content->getDomain();
    }

    /**
     * Return route's url from a content
     *
     * @param Category|Section|Content $content
     * @return string
     */
    private function routeUrlFromContent($content)
    {
        if ($content instanceof Category && $this->getHostFromContent($content)) {
            return '/';
        }
        $url = $content->getSlug();
        if ($content instanceof Content) {
            $url = $content->getSection()->getSlug() . '/' . $url;
            $content = $content->getSection();
        }
        if ($content instanceof Section && !$this->getHostFromContent($content)) {
            $url = $content->getCategory()->getSlug() . '/' . $url;
        }
        return '/' . $url;
    }

    /**
     * Return route's name from a content
     *
     * @param Category|Section|Content $content
     * @return string
     */
    private function routeNameFromContent($content)
    {
        $name = $content->getSlug();
        if ($content instanceof Content) {
            $name = $content->getSection()->getSlug() . '_' . $name;
            $content = $content->getSection();
        }
        if ($content instanceof Section) {
            $name = $content->getCategory()->getSlug() . '_' . $name;
        }
        return $name;
    }

    /**
     * Check if route's name is available
     *
     * @param string $name
     * @return boolean
     */
    private function isRouteNameAvailable($name)
    {
        if ($this->routeProvider->getRoutesByNames([$name])) {
            return false;
        }
        return true;
    }

    /**
     * Add suffix to a string
     *
     * @param string $name
     * @return string
     */
    private function addSuffix($name)
    {
        if (!preg_match('/-(\d*)$/', $name)) {
            return $name . '-1';
        }
        return preg_replace_callback('/-(\d*)$/', function ($matches) {
            return '-' . ($matches[1] + 1);
        }, $name);
    }
}
