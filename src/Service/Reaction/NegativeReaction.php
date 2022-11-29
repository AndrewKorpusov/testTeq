<?php

namespace App\Service\Reaction;

use App\Entity\Reaction;

class NegativeReaction implements ReactionInterface
{
    private $type;

    public function __construct()
    {
        $this->type = Reaction::TYPE_NEGATIVE;
    }

    public function getType(): string
    {
        return $this->type;
    }
}