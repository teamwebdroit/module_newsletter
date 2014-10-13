<?php namespace Droit\Content\Entities;

use Droit\Common\BaseModel as BaseModel;

class Analyse extends BaseModel {

	protected $guarded   = array();
    public static $rules = array();
    public static $messages = array();

    protected $table    = 'analyses';
    protected $fillable = ['pid','user_id','deleted','authors','pub_date','abstract','pub_text','file','categories','arrets'];
    protected $dates    = ['pub_date','created_at','updated_at'];

    public function analyses_categories()
    {
        return $this->belongsToMany('\Droit\Categorie\Entities\Categories', 'analyse_categories', 'analyse_id', 'categories_id');
    }
    
	public function analyses_arrets()
    {     
        return $this->belongsToMany('Droit\Content\Entities\Arret', 'analyses_arret', 'analyse_id', 'arret_id');
    }

}
