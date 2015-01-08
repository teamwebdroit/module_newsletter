<?php namespace Droit\User\Entities;

use Droit\Common\BaseModel as BaseModel;

class Role extends BaseModel{

    /**
     * Set timestamps off
     */
    public $timestamps = false;

    /**
     * Get users with a certain role
     */
    public function users()
    {
        return $this->belongsToMany('\Droit\User\Entities\User', 'users_roles');
    }
}