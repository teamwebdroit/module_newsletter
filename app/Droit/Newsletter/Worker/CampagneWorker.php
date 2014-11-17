<?php namespace Droit\Newsletter\Worker;

use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;
use Droit\Content\Repo\ArretInterface;
use \InlineStyle\InlineStyle;

class CampagneWorker implements CampagneInterface{

    protected $content;
    protected $campagne;
    protected $arret;
    protected $mailjet;
    protected $list;

	public function __construct(NewsletterContentInterface $content,NewsletterCampagneInterface $campagne, ArretInterface $arret)
	{
        $this->content  = $content;
        $this->campagne = $campagne;
        $this->arret    = $arret;

        $this->mailjet  = new \Droit\Newsletter\Service\Mailjet('345390d23793bc89d2237127a2f20b31','2c8f8269df093b24496329894e2ca438');
        $this->list     = '580978';
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

    public function html($id)
    {
        $htmldoc = new InlineStyle(file_get_contents( url('admin/campagne/view/'.$id)));
        $htmldoc->applyStylesheet($htmldoc->extractStylesheets());

        $html = $htmldoc->getHTML();
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);

        return $html;
    }

    /**
     * get infos list
     */
    public function getListInfos(){

        # Call
        $response = $this->mailjet->listsAll();

        # Result
        return $response->lists;

    }

    /**
     * get Subscribers
     */
    public function getSubscribers(){

        # Parameters
        $params = array('id' => $this->list);

        # Call
        $response = $this->mailjet->listsContacts($params);

        # Result
        /*
        $contacts = $response->result;
        $count    = $response->total_cnt;
        */

        return $response;
    }

    /**
     * add new contact
     */
    public function addContact($email){

        $params = array(
            'method'  => 'POST',
            'contact' => $email,
            'id'      => $this->list
        );

        $response = $this->mailjet->listsAddContact($params);

        return ($response ? true : false);

    }

    /**
     * remove contact
     */
    public function removeContact($email){

        $params = array(
            'method'  => 'POST',
            'contact' => $email,
            'id'      => $this->list
        );

        $response = $this->mailjet->listsRemoveContact($params);

        return ($response ? true : false);

    }

    /**
     * create new campagne
     */
    public function createCampagne($campagne){

        # Parameters
        $params = array(
            'method'    => 'POST',
            'subject'   => $campagne->sujet.' | '.$campagne->newsletter->titre,
            'list_id'   => $this->list,
            'lang'      => 'fr',
            'from'      => 'info@leschaud.ch',
            'from_name' => $campagne->newsletter->from_name,
            'footer'    => 'default'
        );

        # Call
        $response = $this->mailjet->messageCreateCampaign($params);

        if($response)
        {
            $campagne->api_campagne_id = $response->campaign->id;
            $campagne->save();

            return true;
        }

        # Result
        //$url = $response->campaign->url;

        return false;

    }

    public function setHtml($html,$id){

        # Parameters
        $params = array(
            'method' => 'POST',
            'id'     => $id,
            'html'   => $html,
        );

        # Call
        $response = $this->mailjet->messageSetHtmlCampaign($params);

        return ($response ? $response : false);

    }

}
