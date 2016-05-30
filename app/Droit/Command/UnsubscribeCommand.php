<?php namespace Droit\Command;

class UnsubscribeCommand
{

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $newsletter_id;

    /**
     * @param string email
     * @param string newsletter_id
     */
    public function __construct($email, $newsletter_id)
    {
        $this->email = $email;
        $this->newsletter_id = $newsletter_id;
    }
}
