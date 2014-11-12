<?php namespace Droit\Command;

class NewsletterSubscribeCommand {

    public $email;
    public $newsletter;

    public function __construct($email, $newsletter)
    {
        $this->email      = $email;
        $this->newsletter = $newsletter;
    }
}