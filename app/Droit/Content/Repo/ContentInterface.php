<?php namespace Droit\Content\Repo;

interface ContentInterface {

    public function getAll($pid);
	public function find($id);
    public function findyBySlug($file);
	public function create(array $data);
	public function update(array $data);
	public function delete($id);

}
