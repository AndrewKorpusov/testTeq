<?php

namespace App\Service;

use App\Entity\CV;
use Doctrine\ORM\EntityManagerInterface;

class CVManager
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function findCVToNotify()
    {
        $cvRepository = $this->em->getRepository(CV::class);


    }
}