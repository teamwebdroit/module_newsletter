<?php namespace Droit\Categorie\Repo;

use Droit\Service\Worker\UploadInterface;
use Droit\Categorie\Repo\CategorieInterface;
use Droit\Categorie\Entities\Categories as M;

class CategorieEloquent implements CategorieInterface{

    protected $categorie;

    public function __construct(M $categorie)
    {
        $this->categorie = $categorie;
    }

    public function getAll($pid){

        return $this->categorie->where('pid','=',$pid)->where('deleted', '=', 0)->get();
    }

    public function find($id){

        return $this->categorie->with(array('categorie_arrets'))->findOrFail($id);
    }

    public function findyByImage($file){

        return $this->categorie->where('image','=',$file)->where('deleted', '=', 0)->get();
    }

    public function create(array $data){

        $categorie = $this->categorie->create(array(
            'pid'        => $data['pid'],
            'user_id'    => $data['user_id'],
            'title'      => $data['title'],
            'image'      => $data['image'],
            'created_at' => date('Y-m-d G:i:s'),
            'updated_at' => date('Y-m-d G:i:s')
        ));

        if( ! $categorie )
        {
            return false;
        }

        return $categorie;

    }

    public function update(array $data){

        $categorie = $this->categorie->findOrFail($data['id']);

        if( ! $categorie )
        {
            return false;
        }

        $categorie->title = $data['title'];

        if(!empty($data['image'])){
            $categorie->image = $data['image'];
        }

        $categorie->updated_at = date('Y-m-d G:i:s');
        $categorie->save();

        return $categorie;
    }

    public function delete($id){

        $categorie = $this->categorie->find($id);

        return $categorie->delete();
    }

}
