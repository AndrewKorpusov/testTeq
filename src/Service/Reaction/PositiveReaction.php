<?php

namespace App\Service\Reaction;

use App\Entity\Reaction;

class PositiveReaction implements ReactionInterface
{
    private $type;

    public function __construct()
    {
        $this->type = Reaction::TYPE_POSITIVE;
    }

    public function getType(): string
    {
        return $this->type;
    }
}