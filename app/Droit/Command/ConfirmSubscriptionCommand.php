<?php namespace Droit\Command;

class ConfirmSubscriptionCommand
{

    /**
     * @var string
     */
    public $token;

    /**
     * @param string token
     */
    public function __construct($token)
    {
        $this->token = $token;
    }
}
