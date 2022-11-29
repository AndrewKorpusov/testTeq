<?php

namespace App\Consumer;



use App\Service\ReactionManager;
use OldSound\RabbitMqBundle\RabbitMq\ConsumerInterface;
use PhpAmqpLib\Message\AMQPMessage;

class ReactionConsumer implements ConsumerInterface
{
    public function __construct(private ReactionManager $reactionManager)
    {
    }

    public function execute(AMQPMessage $msg)
    {
        //TODO: Find all reactions for CV and send email to candidate
    }
}