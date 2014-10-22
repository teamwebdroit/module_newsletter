<?php namespace Droit\Newsletter\Worker;

interface CampagneInterface {

	public function findCampagneById($id);
    public function getCampagne($id);

}
