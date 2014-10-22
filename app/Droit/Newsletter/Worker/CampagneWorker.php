<?php namespace Droit\Newsletter\Worker;

use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;
use Droit\Content\Repo\ArretInterface;

class CampagneWorker implements CampagneInterface{

    protected $content;

    protected $campagne;

    protected $arret;

	public function __construct(NewsletterContentInterface $content,NewsletterCampagneInterface $campagne, ArretInterface $arret)
	{
        $this->content  = $content;

        $this->campagne  = $campagne;

        $this->arret    = $arret;
	}

    public function getCampagne($id){

        return $this->campagne->find($id);
    }

	public function findCampagneById($id){

        $content  = $this->content->getByCampagne($id);

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

        return $campagne;
	}

}
