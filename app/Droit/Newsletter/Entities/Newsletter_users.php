<?php namespace Droit\Newsletter\Entities;

use Droit\Common\BaseModel as BaseModel;

class Newsletter_users extends BaseModel {

    protected $dates = ['activated_at'];

    /*
     * Validation rules
    */
    protected static $rules = array(
        'email' => 'required|email'
    );

    /*
     * Validation messages
    */
    protected static $messages = array(
        'email.required' => 'L\'email est requis',
        'email.email'    => 'Veuillez entrer une adresse email valide'
    );

	protected $fillable = ['email','prenom','nom'];
}