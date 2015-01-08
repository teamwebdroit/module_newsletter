<?php namespace Droit\User\Entities;

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

use Droit\Common\BaseModel as BaseModel;

class User extends BaseModel implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

    protected $fillable = ['prenom','nom','email','password'];

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

    /*
   * Validation rules
  */
    protected static $rules = array(
        'email'     => 'required|email',
        'password'  => 'required'
    );

    /*
     * Validation messages
    */
    protected static $messages = array(
        'email.required'     => 'L\'email est requis',
        'email.email'        => 'L\'email n\'est pas valide',
        'password.required'  => 'Le mot de passe est requis'
    );

    /**
     * Get the roles a user has
     */
    public function roles()
    {
        return $this->belongsToMany('\Droit\User\Entities\Role', 'users_roles');
    }

    /**
     * Find out if user has a specific role
     *
     * $return boolean
     */
    public function hasRole($check)
    {
        return in_array($check, array_fetch($this->roles->toArray(), 'name'));
    }

}
