<?php namespace Droit\Newsletter\Repo;

interface NewsletterUserInterface {

	public function getAll();
	public function find($id);
	public function findByEmail($email);
    public function get_ajax( $sEcho , $iDisplayStart , $iDisplayLength , $iSortCol_0, $sSortDir_0);
    public function activate($token);
	public function create(array $data);
	public function update(array $data);
    public function add(array $data);
	public function delete($id);

}
