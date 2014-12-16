<?php namespace Droit\Newsletter\Worker;

use \InlineStyle\InlineStyle;
use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterTypesInterface;
use Droit\Content\Repo\ArretInterface;

class NewsletterWorker {

    protected $content;
    protected $types;
    protected $arret;
    protected $custom;

    /* Inject dependencies */
    public function __construct( NewsletterContentInterface $content, NewsletterTypesInterface $types, ArretInterface $arret)
    {
        $this->content = $content;
        $this->types   = $types;
        $this->arret   = $arret;
        $this->custom  = new \Custom;
    }


}