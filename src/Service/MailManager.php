<?php

namespace App\Service;

use App\Entity\CV;
use App\Entity\Reaction;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailManager
{
    public function __construct(private MailerInterface $mailer)
    {
    }

    public function sendReactionEmail($to, $text)
    {
        $email = (new Email())
            ->to($to)
            ->text($text);

        $this->mailer->send($email);
    }
}