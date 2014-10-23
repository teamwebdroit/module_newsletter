<?php namespace Droit\Newsletter\Repo;

use Droit\Newsletter\Repo\NewsletterUserInterface;

use Droit\Newsletter\Entities\Newsletter_users as M;

class NewsletterUserEloquent implements NewsletterUserInterface{

	protected $abo;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(M $abo)
	{
		$this->abo = $abo;
	}
	
	public function getAll(){
		
		return $this->abo->all();
	}

	public function find($id){
				
		return $this->abo->findOrFail($id);
	}

    public function activate($token){

        $abo = $this->abo->where('activation_token','=',$token)->get()->first();

        if( ! $abo )
        {
            return false;
        }

        $abo->activated_at = date('Y-m-d G:i:s');
        $abo->save();

        return $abo;

    }

	public function create(array $data){

        $token = $data['email'].date('Y-m-d G:i:s');
        $token = Hash::make($token);

		$abo = $this->abo->create(array(
			'email'            => $data['email'],
			'prenom'           => $data['prenom'],
            'nom'              => $data['nom'],
            'activation_token' => $token,
			'created_at'       => date('Y-m-d G:i:s'),
			'updated_at'       => date('Y-m-d G:i:s')
		));
		
		if( ! $abo )
		{
			return false;
		}
		
		return $abo;
		
	}
	
	public function update(array $data){

        $abo = $this->abo->findOrFail($data['id']);
		
		if( ! $abo )
		{
			return false;
		}

        $abo->email       = $data['email'];
		$abo->prenom      = $data['prenom'];
        $abo->nom         = $data['nom'];
		$abo->updated_at  = date('Y-m-d G:i:s');

		$abo->save();
		
		return $abo;
	}

	public function delete($id){

        $abo = $this->abo->find($id);

		return $abo->delete();
		
	}

					
}
