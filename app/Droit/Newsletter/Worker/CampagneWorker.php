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

        $this->mailjet  = new \Droit\Newsletter\Service\Mailjet();
        $this->list     = '1';
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

        $params = array(
            "method" => "VIEW",
            "ID"     => $this->list
        );

        $result = $this->mailjet->contactslist($params);

        if ($this->mailjet->_response_code == 200)
            return $result;
        else
            return $this->mailjet->_response_code;

    }

    public function getAllSubscribers(){
        # Parameters
        $params = array(
            "method"       => "LIST",
            "ContactsList" => $this->list
        );

        # Call
        $response = $this->mailjet->contact($params);

        return $response;
        //return ($response ? $response->stats : false);
    }

    /**
     * add new contact
     */
    public function addContact($email){

        $params = array(
            'method' => 'POST',
            'Email'  => $email
        );

        $result = $this->mailjet->contact($params);

        if ($this->mailjet->_response_code == 200)
            return $result->Data[0]->ID;
        else
            return $this->getContactByEmail($email);

    }

    public function getContactByEmail($contactEmail) {

        $params = array(
            "method" => "VIEW",
            "ID"     => $contactEmail
        );

        $result = $this->mailjet->contact($params);

        return ($this->mailjet->_response_code == 200 ? $result->Data[0]->ID : $result);
    }

    public function addContactToList($contactID) {

        $params = array(
            "method"    => "POST",
            "ContactID" => $contactID,
            "ListID"    => $this->list,
            "IsActive"  => "True"
        );

        $result = $this->mailjet->listrecipient($params);

        return ($this->mailjet->_response_code == 201 ? $result : false);

    }

    /**
     * remove contact
     */
    public function removeContact($email){

        $listRecipientID = $this->getListRecipient($email);

        $params = array(
            "method" => "DELETE",
            "ID"     => $listRecipientID
        );

        $this->mailjet->listrecipient($params);

        if (($this->mailjet->_response_code == 200) || ($this->mailjet->_response_code == 202) || ($this->mailjet->_response_code == 204))
            return true;
        else
            return false;

    }

    public function getListRecipient($email){

        $params = array(
            "method"        => "GET",
            "ContactsList"  => $this->list,
            "ContactEmail"  => $email,
        );

        $listerecipient = $this->mailjet->listrecipient($params);

        if ($this->mailjet->_response_code == 200)
            return $listerecipient->Data[0]->ID;
        else
            return false;

    }

    /**
     * create new campagne
     */
    public function createCampagne($campagne){

        # Parameters
        $params = array(
            'method'         => 'POST',
            'Title'          => $campagne->newsletter->titre,
            'Subject'        => $campagne->sujet,
            'ContactsListID' => $this->list,
            'Locale'         => 'fr',
            'Callback'       => url('/api'),
            'HeaderLink'     => url('/'),
            'SenderEmail'    => 'droitformation.web@gmail.com',
            'Sender'         => $campagne->newsletter->from_name
        );

        # Call
        $response = $this->mailjet->newsletter($params);

        if($response)
        {
            $campagne->api_campagne_id = $response->Data[0]->ID;
            $campagne->save();

            return true;
        }

        return false;

    }

    public function setHtml($html,$id){

        # Parameters
        $params = array(
            'method'        => 'PUT',
            '_newsletter_id' => $id,
            'html_content'  => $html,
        );

        # Call
        $response = $this->mailjet->addHTMLbody($params);

        return ($response ? $response : false);

    }


    public function sendTest($email,$html,$sujet){

        $params = array(
            "method"  => "POST",
            "from"    => "droitformation.web@gmail.com",
            "to"      => $email,
            "subject" => $sujet,
            "html"    => $html
        );

        $result = $this->mailjet->sendEmail($params);

        if ($this->mailjet->_response_code == 200)
            return $result;
        else
            return $result;

    }

    public function sendCampagne($id,$CampaignID){

        $params = array(
            "method"     => "POST",
            "Status"     => "upload",
            "unique"     => 'camp_'.$CampaignID,
            "JobType"    => "Send newsletter",
            "RefID"      => $id
        );

        $result = $this->mailjet->batchjob($params);

        if ($this->mailjet->_response_code == 201)
           return true;
        else
           return $result;

    }

    public function statsCampagne($id){

        # Parameters
        $params = array( "method" => "VIEW" , 'unique' => 'mj.nl='.$id);

        # Call
        $response = $this->mailjet->campaignstatistics($params);

        return $response;

    }

    public function statsListe(){

        # Parameters
        $params = array( "method" => "GET", 'ListRecipientID' => $this->list );

        # Call
        $response = $this->mailjet->listrecipientstatistics($params);

        return $response;
        //return ($response ? $response->stats : false);

    }

    public function campagneAggregate($id){

        # Parameters
        $params = array( "method" => "LIST", 'CampaignID' => $id );

        # Call
        $response = $this->mailjet->clickstatistics($params);

        return $response;
        //return ($response ? $response->stats : false);

    }

}
