<?php

namespace App\EventListener;


use App\Entity\User;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserListener
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function preUpdate(PreUpdateEventArgs $args)
    {
        $entity = $args->getObject();

        if ($entity instanceof User ) {
            if (!empty($entity->getPassword())) {
                $entity->setPassword($this->passwordHasher->hashPassword($entity, $entity->getPassword()));
            } else {
                if ($args->hasChangedField('password')) {
                    $entity->setPassword($args->getOldValue('password'));
                }
            }
        }
    }
}