<?php namespace Droit\Command;

class SendCampagneCommand {

    /**
     * @var string
     */
    public $id;

    /**
     * @var string
     */
    public $email;

    /**
     * @param string id
     * @param string email
     */
    public function __construct($id, $email)
    {
        $this->id    = $id;
        $this->email = $email;
    }

}