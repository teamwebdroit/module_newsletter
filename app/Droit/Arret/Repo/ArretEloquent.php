<?php namespace Droit\Arret\Repo;

use Droit\Arret\Repo\ArretInterface;
use Droit\Arret\Entities\Arret as M;

class ArretEloquent implements ArretInterface{

	protected $arret;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(M $arret)
	{
		$this->arret = $arret;
	}

    public function getAll(){

        return $this->arret->all();

    }

	public function find($id){
				
		return $this->arret->findOrFail($id);
	}

	public function create(array $data){

		$arret = $this->arret->create(array(
			'pid'        => $data['pid'],
			'user_id'    => $data['user_id'],
            'reference'  => $data['reference'],
            'pub_date'   => $data['pub_date'],
            'abstract'   => $data['abstract'],
            'pub_text'   => $data['pub_text'],
            'categories' => $data['categories'],
            'analysis'   => $data['analysis'],
			'created_at' => date('Y-m-d G:i:s'),
			'updated_at' => date('Y-m-d G:i:s')
		));

		if( ! $arret )
		{
			return false;
		}
		
		return $arret;
		
	}
	
	public function update(array $data){

        $arret = $this->arret->findOrFail($data['id']);
		
		if( ! $arret )
		{
			return false;
		}

        $arret->pid        = $data['pid'];
		$arret->user_id    = $data['user_id'];
        $arret->reference  = $data['reference'];
        $arret->pub_date   = $data['pub_date'];
        $arret->abstract   = $data['abstract'];
        $arret->pub_text   = $data['pub_text'];
        $arret->categories = $data['categories'];
        $arret->analysis   = $data['analysis'];
		$arret->updated_at = date('Y-m-d G:i:s');

		$arret->save();
		
		return $arret;
	}

	public function delete($id){

        $arret = $this->arret->find($id);

		return $arret->delete();
		
	}

					
}
