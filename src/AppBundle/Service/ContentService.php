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
     * Constructor
     *
     * @param RouteProvider $routeProvider
     * @param ContentRepository $contentRepository
     */
    public function __construct(RouteProvider $routeProvider, ContentRepository $contentRepository)
    {
        $this->routeProvider = $routeProvider;
        $this->contentRepository = $contentRepository;
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
        $routeName = $this->routeNameFromContent($content);
        if (!$this->isRouteNameAvailable($routeName)) {
            $route->setName($this->addSuffix($routeName));
        } else {
            $route->setName($routeName);
        }
        $route->setStaticPrefix($this->urlFromName($route->getName()));
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
                if (!$this->isRouteNameAvailable($newName)) {
                    $route->setName($this->addSuffix($newName));
                } else {
                    $route->setName($newName);
                }
                $route->setStaticPrefix($this->urlFromName($route->getName()));
                $routes[$key] = $route;
            }
        }
        return $content;
    }

    /**
     * Return url string from a route name
     *
     * @param string $name
     * @return string
     */
    private function urlFromName($name)
    {
        return '/' . str_replace('_', '/', $name);
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
