<?php namespace Droit\Categorie\Entities;

use Droit\Common\BaseModel as BaseModel;

class Categories extends BaseModel {

	protected $fillable = ['pid','user_id','deleted','title','image','ismain','hideOnSite'];
    protected $dates    = ['created_at','updated_at'];

    public static $rules = array(
        'title' => 'required'
    );

    public static $messages = array(
        'title.required' => 'Le titre est requis'
    );

    public function categorie_arrets()
    {
        return $this->belongsToMany('\Droit\Content\Entities\Arret', 'arret_categories', 'categories_id', 'arret_id');
    }
}