<?php

namespace App\Service;

use Symfony\Component\Security\Core\Security;

class UserManager
{
    public function __construct(private Security $security)
    {
    }

    public function getUser()
    {
        return $this->security->getUser();
    }
}