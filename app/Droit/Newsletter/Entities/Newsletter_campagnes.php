<?php namespace Droit\Newsletter\Entities;

class Newsletter_campagnes extends \Eloquent {
	protected $fillable = ['sujet','auteurs','newsletter_id'];
}