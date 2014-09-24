<?php namespace Droit\Arret\Entities;

class Arret extends \Eloquent {

	protected $fillable = ['pid','user_id','deleted','reference','pub_date','abstract','pub_text','file','categories','analysis'];

}
