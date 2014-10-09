<?php namespace Droit\Content\Repo;

interface ArretInterface {

    public function getAll($pid);
	public function find($data);
	public function create(array $data);
	public function update(array $data);
	public function delete($id);

}
