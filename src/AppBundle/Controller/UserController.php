<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;

/**
 * User Controller
 * @Rest\RouteResource("User")
 */
class UserController extends Controller
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    
    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoderInterface;


    public function __construct(
        EntityManagerInterface $em,
        UserPasswordEncoderInterface $userPasswordEncoderInterface
    ) {
        $this->em = $em;
        $this->userPasswordEncoderInterface = $userPasswordEncoderInterface;
    }

    /**
     * @Rest\View(serializerGroups={"User:details"})
     * @Security("has_role('ROLE_USER')")
     * @return \FOS\RestBundle\View\View
     */
    public function getAction()
    {
        $user = $this->getUser();
        if (!$user) {
            return new JsonResponse(['message' => 'error.user_not_found'], Response::HTTP_NOT_FOUND);
        }
        return ['data' => $user];
    }
    
    /**
     * @ParamConverter("user", converter="fos_rest.request_body")
     * @Rest\View
     */
    public function postAction(User $user, ConstraintViolationListInterface $validationErrors)
    {
        if (count($validationErrors) > 0) {
            $invalidParams = [];
            foreach ($validationErrors as $error) {
                $invalidParams[] = ['error' => $error->getMessage(), 'field' => $error->getPropertyPath()];
            }
            return new JsonResponse(
                [
                    'message' => 'error.validation_error',
                    'invalidParams' => $invalidParams
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $encoded = $this->userPasswordEncoderInterface->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($encoded);
        $user->setRoles(["ROLE_USER"]);
        $this->em->persist($user);
        $this->em->flush();
        return ['data' => $user];
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @Rest\View
     */
    public function patchAction(Request $request)
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        
        $form->submit($request->request->all(), true);
        
        if ($form->isValid()) {
            $this->em->persist($user);
            $this->em->flush();
            return ['data' => $user];
        } else {
            $invalidParams = [];
            foreach ($form->getErrors(true) as $error) {
                $invalidParams[] = ['error' => $error->getMessage(), 'field' => $error->getCause()->getPropertyPath()];
            }
            return new JsonResponse(
                [
                    'message' => 'error.validation_error',
                    'invalidParams' => $invalidParams
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
    }
}
