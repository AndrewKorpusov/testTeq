<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;

class UserProvider implements UserProviderInterface
{
    public function __construct(private EntityManagerInterface $em)
    {
    }

    public function loadUserByUsername(string $email): User
    {
        $user = $this->findOneUserBy(['email' => $email]);

        if (!$user) {
            throw new UserNotFoundException(
                sprintf(
                    'User with "%s" email does not exist.',
                    $email
                )
            );
        }

        return $user;
    }

    private function findOneUserBy(array $options): ?User
    {
        return $this->em
            ->getRepository(User::class)
            ->findOneBy($options);
    }

    public function refreshUser(UserInterface $user): ?User
    {
        assert($user instanceof User);

        if (null === $reloadedUser = $this->findOneUserBy(['id' => $user->getUserIdentifier()])) {
            throw new UserNotFoundException(sprintf('User with ID %s not found', $user->getId()));
        }

        return $reloadedUser;
    }

    public function supportsClass(string $class): bool
    {
        return $class === User::class;
    }
}