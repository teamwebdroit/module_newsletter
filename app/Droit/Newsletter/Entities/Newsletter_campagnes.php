<?php namespace Droit\Newsletter\Entities;

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use Droit\Common\BaseModel as BaseModel;

class Newsletter_campagnes extends BaseModel {


	protected $fillable = ['sujet','auteurs','newsletter_id'];
}