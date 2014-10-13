<?php namespace Droit\Categorie\Entities;

use Droit\Common\BaseModel as BaseModel;

class Categories extends BaseModel {

	protected $fillable = ['pid','user_id','deleted','title','image','ismain'];
    protected $dates    = ['created_at','updated_at'];

    public static $rules = array();
    public static $messages = array();
}