<?php namespace Droit\Newsletter\Worker;

use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;
use Droit\Content\Repo\ArretInterface;
use Droit\Content\Worker\ArretWorker;
use \InlineStyle\InlineStyle;

class CampagneWorker implements CampagneInterface{

    protected $content;
    protected $campagne;
    protected $arret;
    protected $worker;

	public function __construct(NewsletterContentInterface $content,NewsletterCampagneInterface $campagne, ArretInterface $arret)
	{
        $this->content  = $content;
        $this->campagne = $campagne;
        $this->arret    = $arret;
        $this->worker   = new \Droit\Content\Worker\ArretWorker;
	}

    public function getCampagne($id){

        return $this->campagne->find($id);
    }

	public function findCampagneById($id){

        $content  = $this->content->getByCampagne($id);

        if(!$content->isEmpty()){

            $campagne = $content->map(function($item)
            {
                if ($item->arret_id > 0)
                {
                    $arret = $this->arret->find($item->arret_id);

                    if($arret->dumois)
                    {
                        $analyses = $this->worker->getAnalyseForArret($arret);
                        $arret->setAttribute('analyses',$analyses);
                    }

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

            return $campagne;
        }

        return [];
	}

    public function html($id)
    {
        $htmldoc = new InlineStyle(file_get_contents( url('campagne/'.$id)));
        $htmldoc->applyStylesheet($htmldoc->extractStylesheets());

        $html = $htmldoc->getHTML();
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);

        return $html;
    }

}
