<?php

namespace App\Service;

use App\Entity\CV;
use App\Entity\Reaction;
use App\Service\Reaction\ReactionInterface;
use Doctrine\ORM\EntityManagerInterface;

class ReactionManager
{
    private $user;

    public function __construct(private EntityManagerInterface $entityManager, private UserManager $userManager)
    {
    }

    public function addReaction(CV $cv, ReactionInterface $reaction): void
    {
        $this->user = $this->userManager->getUser();

        if ($this->checkReactionIsExisted($cv, $reaction)) {
            $this->removeReaction($cv, $reaction);
        } else {
            $reaction = (new Reaction())
                ->setCv($cv)
                ->setCompany($this->user->getCompany())
                ->setType($reaction->getType());

            $this->entityManager->persist($reaction);
            $this->entityManager->flush();
        }
    }

    private function removeReaction(CV $CV, ReactionInterface $reaction): void
    {
        $repository = $this->entityManager->getRepository(Reaction::class);

        $reaction = $repository->findOneBy([
            'cv' => $CV,
            'company' => $this->user->getCompany(),
            'reaction' => $reaction->getType()
        ]);

        if ($reaction) {
            $CV->removeReaction($reaction);
            $this->entityManager->remove($reaction);

            $this->entityManager->flush();
        }
    }


    private function checkReactionIsExisted(CV $cv, ReactionInterface $reaction): int
    {
        return $this->entityManager->getRepository(Reaction::class)->count([
            'company' => $this->user->getCompany(),
            'cv' => $cv,
            'type' => $reaction->getType()
        ]);
    }
}