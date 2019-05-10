<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use AppBundle\Repository\UserRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\User;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Doctrine\ORM\EntityManagerInterface;

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
     * @var UserRepository $repository
     */
    private $repository;

    /**
     * @var ParamFetcherInterface
     */
    private $paramFetcher;


    public function __construct(
        UserRepository $userRepository,
        ParamFetcherInterface $paramFetcher,
        EntityManagerInterface $em
    ) {
        $this->repository = $userRepository;
        $this->paramFetcher = $paramFetcher;
        $this->em = $em;
    }

    /**
     * @Rest\View(serializerGroups={"User:details"})
     * @Security("has_role('ROLE_USER')")
     * @return \FOS\RestBundle\View\View
     */
    public function getAction()
    {
        $user = $this->repository->find($this->getUser()->getId());
        if (!$user) {
            return new JsonResponse(['message' => 'User not found'], Response::HTTP_NOT_FOUND);
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
            return new JsonResponse(
                [
                    'message' => $validationErrors[0]->getMessage(),
                    'field' => $validationErrors[0]->getPropertyPath()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        if ($this->repository->findByEmail($user->getEmail())) {
            return new JsonResponse(
                [
                    'message' => "unique_email",
                    'field' => "Email"
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $encoder = $this->get('security.password_encoder');
        $encoded = $encoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($encoded);
        $user->setRoles(["ROLE_USER"]);
        $this->em->persist($user);
        $this->em->flush();
    }

    /**
     * @Security("has_role('ROLE_USER')")
     * @ParamConverter("user", converter="fos_rest.request_body")
     * @param int $id
     * @Rest\View
     */
    public function patchAction(User $user, ConstraintViolationListInterface $validationErrors, $id)
    {
        $currentUser = $this->getUser();
        if ($currentUser->getId() !== intval($id)) {
            return new JsonResponse(
                [
                    'message' => 'user.different',
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        if ($currentUser->getEmail() !== $user->getEmail()) {
            if ($this->repository->findByEmail($user->getEmail())) {
                return new JsonResponse(
                    [
                        'message' => "unique_email",
                        'field' => "Email"
                    ],
                    Response::HTTP_UNPROCESSABLE_ENTITY
                );
            }
        }
        if (count($validationErrors) > 0) {
            return new JsonResponse(
                [
                    'message' => $validationErrors[0]->getMessage(),
                    'field' => $validationErrors[0]->getPropertyPath()
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $message = $this->userUpdater($user, $currentUser);
        return new JsonResponse(['message' => $message]);
    }

    private function userUpdater(User $userRequested, User $userModified)
    {
        $editedField = [];

        if ($userRequested->getEmail() !== $userModified->getEmail()) {
            $userModified->setEmail($userRequested->getEmail());
            $editedField[] = ['email'=>'updated.successfully'];
        }

        if ($userRequested->getName() !== $userModified->getName()) {
            $userModified->setName($userRequested->getName());
            $editedField[] = ['name'=>'updated.successfully'];
        }

        if ($userRequested->getConsentName() !== $userModified->getConsentName()) {
            $userModified->setConsentName($userRequested->getConsentName());
            $editedField[] = ['consent_name'=>'updated.successfully'];
        }

        if ($userRequested->getLastName() !== $userModified->getLastName()) {
            $userModified->setLastName($userRequested->getLastName());
            $editedField[] = ['las_name'=>'updated.successfully'];
        }

        if ($userRequested->getConsentLastName() !== $userModified->getConsentLastName()) {
            $userModified->setConsentLastName($userRequested->getConsentLastName());
            $editedField[] = ['consent_last_name'=>'updated.successfully'];
        }

        if ($userRequested->getUsername() !== $userModified->getUsername()) {
            $userModified->setUsername($userRequested->getUsername());
            $editedField[] = ['username'=>'updated.successfully'];
        }

        if ($userRequested->getBirthdate() !== $userModified->getBirthdate()) {
            $userModified->setBirthdate($userRequested->getBirthdate());
            $editedField[] = ['birthdate'=>'updated.successfully'];
        }

        if ($userRequested->getGender() !== $userModified->getGender()) {
            $userModified->setGender($userRequested->getGender());
            $editedField[] = ['gender'=>'updated.successfully'];
        }

        if ($userRequested->getAge() !== $userModified->getAge()) {
            $userModified->setAge($userRequested->getAge());
            $editedField[] = ['age'=>'updated.successfully'];
        }

        if ($userRequested->getStatus() !== $userModified->getStatus()) {
            $userModified->setStatus($userRequested->getStatus());
            $editedField[] = ['status'=>'updated.successfully'];
        }

        if ($userRequested->getConsentMail() !== $userModified->getConsentMail()) {
            $userModified->setConsentMail($userRequested->getConsentMail());
            $editedField[] = ['consent_mail'=>'updated.successfully'];
        }

        if ($userRequested->getAddress() !== $userModified->getAddress()) {
            $userModified->setAddress($userRequested->getAddress());
            $editedField[] = ['address'=>'updated.successfully'];
        }

        if ($userRequested->getZipcode() !== $userModified->getZipcode()) {
            $userModified->setZipcode($userRequested->getZipcode());
            $editedField[] = ['zipcode'=>'updated.successfully'];
        }

        if ($userRequested->getCity() !== $userModified->getCity()) {
            $userModified->setCity($userRequested->getCity());
            $editedField[] = ['city'=>'updated.successfully'];
        }

        if ($userRequested->getDepartment() !== $userModified->getDepartment()) {
            $userModified->setDepartment($userRequested->getDepartment());
            $editedField[] = ['department'=>'updated.successfully'];
        }

        if ($userRequested->getPhone() !== $userModified->getPhone()) {
            $userModified->setPhone($userRequested->getPhone());
            $editedField[] = ['phone'=>'updated.successfully'];
        }

        if ($userRequested->getUsePhone() !== $userModified->getUsePhone()) {
            $userModified->setUsePhone($userRequested->getUsePhone());
            $editedField[] = ['use_phone'=>'updated.successfully'];
        }

        if ($userRequested->getMobile() !== $userModified->getMobile()) {
            $userModified->setMobile($userRequested->getMobile());
            $editedField[] = ['mobile'=>'updated.successfully'];
        }

        if ($userRequested->getUseMobile() !== $userModified->getUseMobile()) {
            $userModified->setUseMobile($userRequested->getUseMobile());
            $editedField[] = ['use_mobile'=>'updated.successfully'];
        }

        if ($userRequested->getConsentNews() !== $userModified->getConsentNews()) {
            $userModified->setConsentNews($userRequested->getConsentNews());
            $editedField[] = ['use_mobile'=>'updated.successfully'];
        }
        if ($userRequested->getPlainPassword() !== null) {
            $encoder = $this->get('security.password_encoder');
            $encodedUserRequestedPassword = $encoder->encodePassword(
                $userRequested,
                $userRequested->getPlainPassword()
            );
    
            if ($encodedUserRequestedPassword !== $userModified->getPassword()) {
                $userRequested->setpassword($encodedUserRequestedPassword);
                $editedField[] = ['password'=>'updated.successfully'];
            }
        }

        $this->em->persist($userModified);
        $this->em->flush();

        return $editedField;
    }
}
