<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * User Controller
 * @Rest\RouteResource("User")
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
     * @Rest\Route("login", name="login_form", requirements={"methods": "POST"})

     * @Rest\View(serializerGroups={"User:details"})
     * @return \FOS\RestBundle\View\View
     */
    public function postLoginAction()
    {
        /**
         * @var AppBundle\Entity\User
         */
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse([
                'status' => 'not logged in'
            ], 201);
        }
        return new JsonResponse(["data" => [
            "email" => $user->getEmail(),
            "name" => $user->getName(),
            "consent_name" => $user->getConsentName(),
            "last_name" => $user->getLastName(),
            "consent_last_name" => $user->getConsentLastName(),
            "username" => $user->getUsername(),
            "birthdate" => $user->getBirthdate(),
            "gender" => $user->getGender(),
            "status" => $user->getStatus(),
            "consent_mail" => $user->getConsentMail(),
            "address" => $user->getAddress(),
            "zipcode" => $user->getZipcode(),
            "city" => $user->getCity(),
            "department" => $user->getDepartment(),
            "phone" => $user->getPhone(),
            "use_phone" => $user->getUsePhone(),
            "mobile" => $user->getMobile(),
            "use_mobile" => $user->getUseMobile(),
            "consent_news" => $user->getConsentNews(),
        ]]);
    }

    /**
     * @Rest\Route("logout", name="logout_form")
     */
    public function logoutAction(): void
    {
        // Left empty intentionally because this will be handled by Symfony.
    }
}
