<?php namespace Droit\Newsletter\Worker;

use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;
use Droit\Content\Repo\ArretInterface;

class CampagneWorker implements CampagneInterface{

    protected $content;
    protected $campagne;
    protected $arret;
    protected $mailjet;

	public function __construct(NewsletterContentInterface $content,NewsletterCampagneInterface $campagne, ArretInterface $arret)
	{
        $this->content  = $content;
        $this->campagne = $campagne;
        $this->arret    = $arret;
        $this->mailjet  = new \Droit\Newsletter\Service\Mailjet('345390d23793bc89d2237127a2f20b31','2c8f8269df093b24496329894e2ca438');
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

    function sendEmail() {

        $params = array(
            "method"  => "POST",
            "from"    => "cindy.leschaud@gmail.com",
            "to"      => "cindy.leschaud@gmail.com",
            "subject" => "Hello World!",
            "text"    => "Greetings from Mailjet."
        );

        $result = $this->mailjet->sendEmail($params);

        if ($this->mailjet->_response_code == 200)
            echo "success - email sent";
        else
            echo "error - ".$this->mailjet->_response_code;

        //return $result;
        return 'ok send';

    }

}
