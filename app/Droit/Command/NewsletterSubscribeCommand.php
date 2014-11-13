<?php namespace Droit\Command;

class NewsletterSubscribeCommand {

    public $email;
    public $newsletter_id;

    public function __construct($email, $newsletter_id)
    {
        $this->email         = $email;
        $this->newsletter_id = $newsletter_id;
    }
}