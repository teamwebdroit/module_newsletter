<?php namespace Droit\Categorie\Repo;

interface CategorieInterface {

    public function getAll($pid);
    public function getAllMain($pid);
    public function find($data);
    public function findyByImage($file);
    public function create(array $data);
    public function update(array $data);
    public function delete($id);

}
