<?php namespace Droit\Command;

class UpdateSubscriberCommand
{

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $email;

    /**
     * @var array
     */
    public $newsletter_id;

    /**
     * @var string
     */
    public $activation;

    /**
     * @param string email
     * @param array newsletter_id
     * @param string activation
     */
    public function __construct($id, $email, $newsletter_id, $activation)
    {
        $this->id            = $id;
        $this->email         = $email;
        $this->newsletter_id = $newsletter_id;
        $this->activation    = $activation;
    }
}
