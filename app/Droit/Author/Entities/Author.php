<?php namespace Droit\Author\Entities;

use Illuminate\Database\Eloquent\Model;

class Author extends Model {

	protected $fillable = ['first_name','last_name','occupation','bio','photo','rang'];
    public $timestamps  = false;

    public static $rules = array(
        'first_name' => 'required',
        'last_name'  => 'required',
        'occupation' => 'required'
    );

    public static $messages = array(
        'first_name.required' => 'Le prénom parent est requis',
        'last_name.required'  => 'Le nom est requis',
        'occupation.required' => 'L\'occupation est requise'
    );

    public function getNameAttribute()
    {
        return $this->first_name.' '.$this->last_name;
    }

    public function getNameTitleAttribute()
    {
        return $this->first_name.' '.$this->last_name.', '.$this->occupation;
    }

/*    public function analyses()
    {
        return $this->hasMany('Droit\Content\Entities\Analyse','author_id');
    }*/

    public function analyses()
    {
        return $this->belongsToMany('Droit\Content\Entities\Analyse', 'analyse_authors','author_id','analyse_id');
    }
}

