<?php

namespace App\Service;

use App\Entity\CV;
use App\Entity\Reaction;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class ReactionManager
{
    public function __construct(private EntityManagerInterface $entityManager, private Security $security)
    {
    }

    public function findReactionsToSend()
    {
        $reactionsRepository = $this->entityManager->getRepository(Reaction::class);

        $reactions = $reactionsRepository->findReactionsToNotify();

    }


    public function addReaction(CV $cv, $type): void
    {
        if ($this->checkReactionIsExisted($cv, $type)) {
            $this->removeReaction($cv, $type);
        } else {
            $reaction = (new Reaction())
                ->setCv($cv)
                ->setCompany()
                ->setType($type);
        }
    }


    private function checkReactionIsExisted(CV $cv, $type)
    {
        $user = $this->security->getUser();

        return $this->entityManager->getRepository(Reaction::class)->count([
            'company' => $user->getCompany(),
            'cv' => $cv,
            'type' => $type
        ]);
    }
}