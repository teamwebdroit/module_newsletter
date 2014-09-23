<?php namespace Droit\Newsletter\Repo;

use Droit\Newsletter\Repo\NewsletterContentInterface;

use Droit\Newsletter\Entities\Newsletter_contents as M;

class NewsletterContentEloquent implements NewsletterContentInterface{

	protected $contents;

	/**
	 * Construct a new SentryUser Object
	 */
	public function __construct(M $contents)
	{
		$this->contents = $contents;
	}
	
	public function getByCampagne($newsletter_campagne_id){
		
		return $this->contents->where('newsletter_campagne_id','=',$newsletter_campagne_id)->get();
	}

	public function find($id){
				
		return $this->contents->where('id','=',$id)->with(array('campagne','newsletter'))->get()->first();
	}

	public function create(array $data){

		$contents = $this->contents->create(array(
			'type'                   => $data['type'],
			'titre'                  => $data['titre'],
            'contenu'                => $data['contenu'],
            'image'                  => $data['image'],
            'arret_id'               => $data['arret_id'],
            'categorie_id'           => $data['categorie_id'],
            'newsletter_campagne_id' => $data['newsletter_campagne_id'],
            'rang'                   => $data['rang'],
			'created_at'             => date('Y-m-d G:i:s'),
			'updated_at'             => date('Y-m-d G:i:s')
		));
		
		if( ! $contents )
		{
			return false;
		}
		
		return $contents;
		
	}
	
	public function update(array $data){

        $contents = $this->contents->findOrFail($data['id']);
		
		if( ! $contents )
		{
			return false;
		}

        $contents->type                   = $data['type'];
		$contents->titre                  = $data['titre'];
        $contents->contenu                = $data['contenu'];
        $contents->image                  = $data['image'];
        $contents->arret_id               = $data['arret_id'];
        $contents->categorie_id           = $data['categorie_id'];
        $contents->newsletter_campagne_id = $data['newsletter_campagne_id'];
        $contents->rang                   = $data['rang'];
		$contents->updated_at             = date('Y-m-d G:i:s');

		$contents->save();
		
		return $contents;
	}

	public function delete($id){

        $contents = $this->contents->find($id);

		return $contents->delete();
		
	}

					
}
