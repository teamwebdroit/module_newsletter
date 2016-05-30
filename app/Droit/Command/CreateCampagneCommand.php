<?php namespace Droit\Command;

class CreateCampagneCommand
{

    /**
     * @var string
     */
    public $sujet;

    /**
     * @var string
     */
    public $auteurs;

    /**
     * @param string sujet
     * @param string auteurs
     */
    public function __construct($sujet, $auteurs)
    {
        $this->sujet   = $sujet;
        $this->auteurs = $auteurs;
    }
}
