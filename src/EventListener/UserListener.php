<?php

namespace App\EventListener;


use App\Entity\User;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserListener
{
    public function __construct(private UserPasswordHasherInterface $passwordHasher)
    {
    }

    public function prePersist(User $user, LifecycleEventArgs $args)
    {
        $this->hashPassword($user);
    }
    public function preUpdate(User $user, PreUpdateEventArgs $args)
    {
        if (!empty($user->getPassword())) {
            $this->hashPassword($user);
        } else {
            if ($args->hasChangedField('password')) {
                $user->setPassword($args->getOldValue('password'));
            }
        }
    }

    private function hashPassword(User $entity)
    {
        $entity->setPassword($this->passwordHasher->hashPassword($entity, $entity->getPassword()));
    }
}