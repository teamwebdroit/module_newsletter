<?php

use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;

class CampagneController extends BaseController {

    protected $content;

    protected $campagne;

    /* Inject dependencies */
    public function __construct( NewsletterContentInterface $content, NewsletterCampagneInterface $campagne )
    {
        $this->content  = $content;
        $this->campagne = $campagne;
    }

    public function index()
    {
        $campagnes = $this->campagne->getAll();

        return View::make('newsletter.index')->with( array('campagnes' => $campagnes) );
    }

    public function create()
    {
        return View::make('newsletter.create');
    }

    public function compose()
    {
        return View::make('newsletter.compose')->with(array( 'isNewsletter' => true ));
    }

}
