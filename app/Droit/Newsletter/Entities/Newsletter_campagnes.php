<?php namespace Droit\Newsletter\Entities;

use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Newsletter_campagnes extends \Eloquent {

    use SoftDeletingTrait;

    protected $dates = ['deleted_at'];

	protected $fillable = ['sujet','auteurs','newsletter_id'];
}