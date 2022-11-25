<?php

namespace App\Controller;

use App\Entity\CV;
use App\Service\ReactionManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ReactionController
{
    public function __construct(private ReactionManager $reactionManager)
    {
    }

    #[Route('add-plus-reaction/{CV}', name: 'add_plus_reaction')]
    public function addPositiveReaction(CV $CV): JsonResponse
    {
        $this->reactionManager->addPositiveReaction($CV);

        return new JsonResponse('ok');
    }

    #[Route('add-minus-reaction/{CV}', name: 'add_minus_reaction')]
    public function addNegativeReaction(CV $CV): JsonResponse
    {
        $this->reactionManager->addNegativeReaction($CV);
    }
}