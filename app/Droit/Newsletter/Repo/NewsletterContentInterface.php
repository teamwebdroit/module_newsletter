<?php namespace Droit\Newsletter\Repo;

interface NewsletterContentInterface {

	public function getByCampagne($newsletter_campagne_id);

	public function find($data);
	
	public function create(array $data);
	public function update(array $data);
	public function delete($id);

}
