<?php namespace Droit\Newsletter\Repo;

use Droit\Newsletter\Entities\Newsletter_users as M;
use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Event\UserWasSubscribed;

class NewsletterUserEloquent implements NewsletterUserInterface{

	protected $subscribe;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(M $subscribe)
	{
		$this->subscribe = $subscribe;
	}
	
	public function getAll(){
		
		return $this->subscribe->all();
	}

	public function find($id){
				
		return $this->subscribe->findOrFail($id);
	}

    public function activate($token){

        $subscribe = $this->subscribe->where('activation_token','=',$token)->get()->first();

        if( ! $subscribe )
        {
            return false;
        }

        $subscribe->activated_at = date('Y-m-d G:i:s');
        $subscribe->save();

        return $subscribe;

    }

	public function create(array $data){

		$subscribe = $this->subscribe->create(array(
			'email'            => $data['email'],
            'activation_token' => $data['activation_token'],
			'created_at'       => date('Y-m-d G:i:s'),
			'updated_at'       => date('Y-m-d G:i:s')
		));
		
		if( ! $subscribe )
		{
			return false;
		}

        $subscribe->raise(new UserWasSubscribed($subscribe));

		return $subscribe;
		
	}
	
	public function update(array $data){

        $subscribe = $this->subscribe->findOrFail($data['id']);
		
		if( ! $subscribe )
		{
			return false;
		}

        $subscribe->email       = $data['email'];
		$subscribe->updated_at  = date('Y-m-d G:i:s');

		$subscribe->save();
		
		return $subscribe;
	}

	public function delete($id){

        $subscribe = $this->subscribe->find($id);

		return $subscribe->delete();
		
	}

					
}
