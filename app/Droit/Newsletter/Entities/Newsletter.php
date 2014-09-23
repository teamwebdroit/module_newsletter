<?php namespace Droit\Newsletter\Entities;

class Newsletter extends \Eloquent {

	protected $fillable = ['titre','from_name','from_email','return_email','unsuscribe','preview','logos','header'];


}