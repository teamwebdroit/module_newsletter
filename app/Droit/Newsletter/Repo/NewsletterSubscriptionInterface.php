<?php namespace Droit\Newsletter\Repo;

interface NewsletterSubscriptionInterface {

	public function getAll($newsletter_id);
	public function find($id);
    public function subscribe(array $data);
	public function delete($id);

}
