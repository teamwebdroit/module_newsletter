<?php namespace Droit\Content\Entities;

use Droit\Common\BaseModel as BaseModel;

class Arret extends BaseModel {

	protected $fillable = ['pid','user_id','deleted','reference','pub_date','abstract','pub_text','file','categories'];
    protected $dates    = ['pub_date','created_at','updated_at'];

    /*
     * Validation rules
    */
    protected static $rules = array(
        'reference' => 'required',
        'pub_date'  => 'required',
        'abstract'  => 'required',
        'pub_text'  => 'required'
    );

    /*
     * Validation messages
    */
    protected static $messages = array(
        'reference.required' => 'La référence est requise',
        'pub_date.required'  => 'La date de publication est requise',
        'abstract.required'  => 'Le résumé est requis',
        'pub_text.required'  => 'Le texte est requis'
    );

    public function arrets_categories()
    {
        return $this->belongsToMany('\Droit\Categorie\Entities\Categories', 'arret_categories', 'arret_id', 'categories_id');
    }

    public function arrets_analyses()
    {
        return $this->belongsToMany('\Droit\Content\Entities\Analyse', 'analyses_arret', 'arret_id', 'analyse_id');
    }

}
