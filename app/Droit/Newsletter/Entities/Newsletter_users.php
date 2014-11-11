<?php namespace Droit\Newsletter\Entities;

use Laracasts\Commander\Events\EventGenerator;

class Newsletter_users extends \Eloquent {

    use EventGenerator;

    protected $dates = ['activated_at'];

	protected $fillable = ['email','activation_token','activated_at'];

    public function getActivatedAtAttribute($timestamp)
    {
        return ( ! starts_with($timestamp, '0000')) ? $this->asDateTime($timestamp) : 'Aucune';
    }

}