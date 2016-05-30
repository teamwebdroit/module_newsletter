<?php namespace Droit\Content\Repo;

interface AnalyseInterface
{

    public function getAll($include = []);
    public function find($data);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);
}
