<?php

namespace App\Controller;

use App\Entity\CV;
use App\Service\Reaction\NegativeReaction;
use App\Service\Reaction\PositiveReaction;
use App\Service\ReactionManager;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ReactionController
{
    public function __construct(private ReactionManager $reactionManager, private PositiveReaction $positiveReaction, private NegativeReaction $negativeReaction)
    {
    }

    #[Route('add-plus-reaction/{CV}', name: 'add_plus_reaction')]
    public function addPositiveReaction(CV $CV): JsonResponse
    {
        $this->reactionManager->addReaction($CV, $this->positiveReaction);

        return new JsonResponse('ok');
    }

    #[Route('add-minus-reaction/{CV}', name: 'add_minus_reaction')]
    public function addNegativeReaction(CV $CV): JsonResponse
    {
        $this->reactionManager->addReaction($CV, $this->negativeReaction);

        return new JsonResponse('ok');
    }
}