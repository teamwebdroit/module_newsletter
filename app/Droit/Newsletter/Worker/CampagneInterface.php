<?php namespace Droit\Newsletter\Worker;

interface CampagneInterface {

	public function findCampagneById($id);
    public function getCampagne($id);
    public function html($id);

    // Call to API Mailjet
    public function getListInfos();
    public function getSubscribers();
    public function getAllSubscribers();
    public function addContact($email);
    public function getContactByEmail($contactEmail);
    public function addContactToList($contactID);
    public function removeContact($email);
    public function getListRecipient($email);
    public function createCampagne($campagne);
    public function setHtml($html,$id);
    public function sendTest($email,$html,$sujet);
    public function sendCampagne($id,$CampaignID);
    public function statsCampagne($id);
    public function statsListe();
    public function campagneAggregate($id);
}
