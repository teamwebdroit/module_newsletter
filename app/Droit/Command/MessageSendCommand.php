<?php namespace Droit\Command;


class MessageSendCommand {

    public $nom;

    public $email;

    public $remarque;

    public function __construct($nom, $email, $remarque) /* or pass in just the relevant fields */
    {
        $this->nom      = $nom;
        $this->email    = $email;
        $this->remarque = $remarque;
    }

}