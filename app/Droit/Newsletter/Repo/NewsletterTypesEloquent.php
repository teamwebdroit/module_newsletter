<?php namespace Droit\Newsletter\Repo;

use Droit\Newsletter\Repo\NewsletterTypesInterface;

use Droit\Newsletter\Entities\Newsletter_types as M;

class NewsletterTypesEloquent implements NewsletterTypesInterface
{

    protected $types;

    /**
     * Construct a new SentryUser Object
     */
    public function __construct(M $types)
    {
        $this->types = $types;
    }
    
    public function getAll()
    {
        
        return $this->types->all();
    }

    public function find($id)
    {
                
        return $this->types->findOrFail($id);
    }

    public function findByPartial($partial)
    {

        return $this->types->where('partial', '=', $partial)->get()->first();
    }

    public function create(array $data)
    {

        $types = $this->types->create(array(
            'type_id'                => $data['type_id'],
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
        
        if (! $types) {
            return false;
        }
        
        return $types;
        
    }
    
    public function update(array $data)
    {

        $types = $this->types->findOrFail($data['id']);
        
        if (! $types) {
            return false;
        }

        $types->type_id                = $data['type_id'];
        $types->titre                  = $data['titre'];
        $types->contenu                = $data['contenu'];
        $types->image                  = $data['image'];
        $types->arret_id               = $data['arret_id'];
        $types->categorie_id           = $data['categorie_id'];
        $types->newsletter_campagne_id = $data['newsletter_campagne_id'];
        $types->rang                   = $data['rang'];
        $types->updated_at             = date('Y-m-d G:i:s');

        $types->save();
        
        return $types;
    }

    public function delete($id)
    {

        $types = $this->types->find($id);

        return $types->delete();
        
    }
}
