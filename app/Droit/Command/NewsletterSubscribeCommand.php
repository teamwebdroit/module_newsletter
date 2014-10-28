<?php namespace Droit\Command;

class NewsletterSubscribeCommand {

    public $email;

    public function __construct($email)
    {
        $this->email  = $email;
    }
}