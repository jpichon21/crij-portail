<?php
/* Copyright (C) Logomotion - All Rights Reserved
 * Unauthorized copying of this file, via any medium is strictly prohibited
 * Proprietary and confidential
 */


namespace AppBundle\Security;

use AppBundle\Exception\AccountDeletedException;
use AppBundle\Entity\User;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use AppBundle\Exception\AccountDisabledException;

class UserChecker implements UserCheckerInterface
{
    public function checkPreAuth(UserInterface $user)
    {
        if (!$user instanceof User) {
            return;
        }

        if ($user->isDeleted()) {
            throw new AccountDeletedException('error.accound.deleted');
        }
    }

    public function checkPostAuth(UserInterface $user)
    {
        if (!$user instanceof User) {
            return;
        }
        if (!$user->isEnabled()) {
            throw new AccountDisabledException('error.account.disabled');
        }
    }
}
