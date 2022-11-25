<?php

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;

class CompanyManager
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function getCompanyFromUser($user)
    {

    }
}