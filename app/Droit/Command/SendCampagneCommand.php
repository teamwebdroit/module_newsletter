<?php namespace Droit\Command;

class SendCampagneCommand
{

    /**
     * @var string
     */
    public $id;

    /**
     * @param string id
     * @param string email
     */
    public function __construct($id)
    {
        $this->id = $id;
    }
}
