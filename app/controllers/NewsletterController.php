<?php

use \InlineStyle\InlineStyle;
use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterTypesInterface;
use Droit\Content\Repo\ArretInterface;
use Droit\Content\Repo\AnalyseInterface;

class NewsletterController extends BaseController {

    protected $content;

    protected $types;

    protected $arret;

    protected $analyse;

    /* Inject dependencies */
    public function __construct( NewsletterContentInterface $content, NewsletterTypesInterface $types, ArretInterface $arret, AnalyseInterface $analyse)
    {

        $this->content = $content;

        $this->types   = $types;

        $this->arret   = $arret;

        $this->analyse = $analyse;

        /*
         * Urls
        */
        $shared['unsuscribe']   = url('/');
        $shared['browser']      = url('/');
        $shared['isNewsletter'] = true;

        View::share( $shared );

    }

    public function index()
    {
        return View::make('newsletter.index');
    }

    public function test()
    {

        $analyse = $this->analyse->find(21);

        return View::make('newsletter.html')->with(array('content' => $analyse));
    }

    public function html()
    {
        $htmldoc = new InlineStyle(file_get_contents('http://newsletter.local/campagne'));
        $htmldoc->applyStylesheet($htmldoc->extractStylesheets());

        $html = $htmldoc->getHTML();

        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);

        echo $html;

        try
        {
            $subject   =  'Newsletter RJN';
            $fromEmail = 'info@rjne.ch';
            $fromName  = 'RJN';

            \Mail::send('emails.newsletter', array('html' => $html) , function($message) use ( $fromEmail,$fromName, $subject )
            {
                $message->to('cindy.leschaud@gmail.com', 'Cindy Leschaud');
                $message->from($fromEmail, $fromName);
                $message->subject($subject);
            });

            echo 'email envoyé!!';

        }
        catch (Exception $e)
        {
            echo 'problème!';
        }
    }

    public function campagne()
    {
        $content  = $this->content->getByCampagne(1);

        $campagne = $content->map(function($item)
        {
            if ($item->arret_id > 0)
            {
                $arret = $this->arret->find($item->arret_id);
                $arret->setAttribute('type',$item->type);
                $arret->setAttribute('rangItem',$item->rang);
                $arret->setAttribute('idItem',$item->id);
                return $arret;
            }
            else
            {
                $item->setAttribute('rangItem',$item->rang);
                $item->setAttribute('idItem',$item->id);
                return $item;
            }
        });

        return View::make('newsletter.show')->with(array('content' => $campagne));
    }

    public function addUser(){

    }

}
