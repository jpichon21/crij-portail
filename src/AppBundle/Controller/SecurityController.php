<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use JMS\Serializer\SerializationContext;

/**
 * User Controller
 */
final class SecurityController extends Controller
{
    /**
     * @var AuthenticationUtils
     */
    private $authenticationUtils;

    public function __construct(AuthenticationUtils $authenticationUtils)
    {
        $this->authenticationUtils = $authenticationUtils;
    }

    /**
     * @Rest\Route("/login", name="api_login", requirements={"methods": "POST"}, options={"method_prefix" = false})
     * @Rest\View(serializerGroups={"User:details"})
     * @return \FOS\RestBundle\View\View
     */
    public function postAction()
    {
        /**
         * @var AppBundle\Entity\User
         */
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['status' => 'not logged in'], Response::HTTP_FORBIDDEN);
        }
        $serializer = $this->get('jms_serializer');
        $data = $serializer->serialize($user, 'json', SerializationContext::create()->setGroups(array('User:details')));
        return new Response($data);
    }

    /**
     * @Rest\Route("/logout", name="api_logout", options={"method_prefix" = false})
     */
    public function logoutAction()
    {
        // Left empty intentionally because this will be handled by Symfony.
    }
}
