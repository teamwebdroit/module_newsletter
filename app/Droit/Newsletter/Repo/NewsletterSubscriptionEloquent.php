<?php namespace Droit\Newsletter\Repo;

use Droit\Newsletter\Entities\Newsletter_subscriptions as M;
use Droit\Newsletter\Repo\NewsletterSubscriptionInterface;

class NewsletterSubscriptionEloquent implements NewsletterSubscriptionInterface{

	protected $subscribe;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(M $subscribe)
	{
		$this->subscribe = $subscribe;
	}
	
	public function getAll($newsletter_id){
		
		return $this->subscribe->where('newsletter_id','=',$newsletter_id)->get();
	}

	public function find($id){
				
		return $this->subscribe->findOrFail($id);
	}

	public function subscribe(array $data){

        foreach($data['newsletter_id'] as $newsletter_id)
        {
            $this->subscribe->create(array(
                'user_id'       => $data['user_id'],
                'newsletter_id' => $newsletter_id,
                'created_at'    => date('Y-m-d G:i:s'),
                'updated_at'    => date('Y-m-d G:i:s')
            ));
        }
	}

    public function delete($id){

        $subscribe = $this->subscribe->find($id);

        return $subscribe->delete();
    }
}
