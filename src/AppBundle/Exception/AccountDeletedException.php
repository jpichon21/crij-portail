<?php
/* Copyright (C) Logomotion - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/
namespace AppBundle\Exception;

use Symfony\Component\Security\Core\Exception\AccountStatusException;

/**
 * AccountDeletedException is thrown when the user account is deleted.
 *
 */
class AccountDeletedException extends AccountStatusException
{
    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        return 'error.account_deleted';
    }
}
