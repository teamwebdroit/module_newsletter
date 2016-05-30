<?php namespace Droit\Content\Repo;

interface ArretInterface
{

    public function getAll($pid);
    public function getAllActives($pid, $include);
    public function getPaginate($pid, $nbr);
    public function getLatest($include);
    public function find($data);
    public function findyByImage($file);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);
}
