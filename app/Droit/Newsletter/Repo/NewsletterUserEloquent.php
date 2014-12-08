<?php namespace Droit\Newsletter\Repo;

use Droit\Newsletter\Entities\Newsletter_users as M;
use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Event\UserWasSubscribed;

class NewsletterUserEloquent implements NewsletterUserInterface{

	protected $user;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(M $user)
	{
		$this->user = $user;
	}
	
	public function getAll(){
		
		return $this->user->with(array('subscription' => function($query)
        {
            $query->join('newsletters', 'newsletters.id', '=', 'newsletter_subscriptions.newsletter_id');
        }))->get();
	}

	public function find($id){
				
		return $this->user->with(array('newsletter','subscription' => function($query)
        {
            $query->join('newsletters', 'newsletters.id', '=', 'newsletter_subscriptions.newsletter_id');
        }))->findOrFail($id);
	}

    public function activate($token){

        $user = $this->user->where('activation_token','=',$token)->get()->first();

        if( ! $user )
        {
            return false;
        }

        $user->activated_at = date('Y-m-d G:i:s');
        $user->save();

        return $user;

    }

	public function create(array $data){

		$user = $this->user->create(array(
			'email'            => $data['email'],
            'activation_token' => $data['activation_token'],
			'created_at'       => date('Y-m-d G:i:s'),
			'updated_at'       => date('Y-m-d G:i:s')
		));
		
		if( ! $user )
		{
			return false;
		}

        $user->raise(new UserWasSubscribed($user));

		return $user;
		
	}
	
	public function update(array $data){

        $user = $this->user->findOrFail($data['id']);
		
		if( ! $user )
		{
			return false;
		}

        $user->activated_at = ( $data['activated_at'] > 0 ? date('Y-m-d G:i:s') : '0000-00-00 00:00:00');
        $user->email        = $data['email'];
		$user->updated_at   = date('Y-m-d G:i:s');

		$user->save();
		
		return $user;
	}

    public function add(array $data){

        $user = $this->user->create(array(
            'email'            => $data['email'],
            'activated_at'     => date('Y-m-d G:i:s'),
            'created_at'       => date('Y-m-d G:i:s'),
            'updated_at'       => date('Y-m-d G:i:s')
        ));

        if( ! $user )
        {
            return false;
        }

        return $user;
    }

	public function delete($email){

		return $this->user->where('email', '=', $email)->delete();
		
	}

}
