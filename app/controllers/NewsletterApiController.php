<?php

use \InlineStyle\InlineStyle;
use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterTypesInterface;
use Droit\Arret\Repo\ArretInterface;

class NewsletterApiController extends BaseController {

    protected $content;

    protected $types;

    protected $arret;

    /* Inject dependencies */
    public function __construct( NewsletterContentInterface $content, NewsletterTypesInterface $types, ArretInterface $arret)
    {

        $this->content = $content;

        $this->types   = $types;

        $this->arret   = $arret;

    }

    public function process(){

        $data = Input::all();

        /* retrive type from database to set it right in content */
        $type = $this->types->findByPartial($data['type']);
        $rang = $this->content->getRang(1);

        $titre    = (isset($data['titre']) ? $data['titre'] : null);
        $contenu  = (isset($data['contenu']) ? $data['contenu'] : null);
        $image    = (isset($data['image']) ? $data['image'] : null);
        $arret_id = (isset($data['arret_id']) ? $data['arret_id'] : 0);

        $new  = array(
            'type_id'                => $type->id,
            'titre'                  => $titre,
            'contenu'                => $contenu,
            'image'                  => $image,
            'arret_id'               => $arret_id,
            'categorie_id'           => 0,
            'newsletter_campagne_id' => 1,
            'rang'                   => $rang
        );

        $contents = $this->content->create($new);

        if($contents)
        {
            return Response::json( $contents, 200 );
        }

        return false;

    }

    public function sorting(){

        $data = Input::all();

        $contents = $this->content->updateSorting($data['bloc_rang']);

        //return Response::json( $data, 200 );

        print_r($data);

       // return false;
    }

    /**
     * Return building blocs for js
     *
     * @return json
     */
    public function building()
    {
        return array( 'blocs' => $this->types->getAll());
    }

    /**
     * Return all arrets for dropdown
     *
     * @return json
     */
    public function all()
    {
        return $this->arret->getAll();
    }

    /**
     * Return one arret by id
     *
     * @return json
     */
    public function simple($id)
    {
        return $this->arret->find($id);
    }

}
