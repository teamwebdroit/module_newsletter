<?php

use \InlineStyle\InlineStyle;
use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterTypesInterface;
use Droit\Arret\Repo\ArretInterface;

class NewsletterController extends BaseController {

    protected $content;

    protected $types;

    protected $arret;

    /* Inject dependencies */
    public function __construct( NewsletterContentInterface $content, NewsletterTypesInterface $types, ArretInterface $arret)
    {

        $this->content = $content;

        $this->types   = $types;

        $this->arret   = $arret;

        /*
         * Urls
        */
        $shared['unsuscribe'] = url('/');
        $shared['browser']    = url('/');

        View::share( $shared );

    }

    public function index()
    {
        return View::make('newsletter.build');
    }

    public function test()
    {
        $content  = $this->content->getByCampagne(1);

        $content = $content->sortByDesc(function($item)
        {
            return $item->rang;
        });

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

        return View::make('newsletter.html')->with(array('content' => $campagne));
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
git status
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

}
