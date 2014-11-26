<?php namespace Droit\Command;

class AdminSubscribeCommand {

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $activation;

    /**
     * @var array
     */
    public $newsletter_id;

    /**
     * @param string email
     */
    public function __construct($email,$activation,$newsletter_id)
    {
        $this->email         = $email;
        $this->activation    = $activation;
        $this->newsletter_id = $newsletter_id;
    }

}