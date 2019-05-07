<?php
/* Copyright (C) Logomotion - All Rights Reserved
* Unauthorized copying of this file, via any medium is strictly prohibited
* Proprietary and confidential
*/
namespace AppBundle\Exception;

use Symfony\Component\Security\Core\Exception\AccountStatusException;


/**
 * AccountDisabledException is thrown when the user account is disabled.
 *
 */
class AccountDisabledException extends AccountStatusException
{
    /**
     * {@inheritdoc}
     */
    public function getMessageKey()
    {
        return 'Account is disabled.';
    }
}
