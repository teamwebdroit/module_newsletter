<?php namespace Droit\Arret\Entities;

class Arret extends \Eloquent {

	protected $fillable = ['pid','user_id','deleted','reference','pub_date','abstract','pub_text','file','categories','analysis'];

    protected $dates = ['pub_date','created_at','updated_at'];

    public function arrets_categories()
    {
        return $this->belongsToMany('\Droit\Categorie\Entities\Ba_categories', 'arret_ba_categories', 'arret_id', 'ba_categories_id');
    }

}
