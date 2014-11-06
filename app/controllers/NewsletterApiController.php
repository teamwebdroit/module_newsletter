<?php

use \InlineStyle\InlineStyle;
use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterTypesInterface;
use Droit\Content\Repo\ArretInterface;

class NewsletterApiController extends BaseController {

    protected $content;

    protected $types;

    protected $arret;

    protected $custom;

    /* Inject dependencies */
    public function __construct( NewsletterContentInterface $content, NewsletterTypesInterface $types, ArretInterface $arret)
    {

        $this->content = $content;

        $this->types   = $types;

        $this->arret   = $arret;

        $this->custom  = new \Custom;

    }

    public function process(){

        $data = Input::all();

        $campagne = $data['campagne'];

        /* retrive type from database to set it right in content */
        $type = $this->types->findByPartial($data['type']);
        $rang = $this->content->getRang($campagne);

        $titre    = (isset($data['titre']) ? $data['titre'] : null);
        $contenu  = (isset($data['contenu']) ? $data['contenu'] : null);
        $image    = (isset($data['image']) ? $data['image'] : null);
        $arret_id = (isset($data['arret_id']) ? $data['arret_id'] : 0);

        $new = array(
            'type_id'                => $type->id,
            'titre'                  => $titre,
            'contenu'                => $contenu,
            'image'                  => $image,
            'arret_id'               => $arret_id,
            'categorie_id'           => 0,
            'newsletter_campagne_id' => $campagne,
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

        print_r($data);

    }

    public function remove(){

        $this->content->delete(Input::get('id'));

        return 'ok';
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
     * Return one arret by id
     *
     * @return json
     */
    public function simple($id)
    {
        return $this->arret->find($id);
    }


    /**
     * Return response arrets prepared for filtered
     *
     * @return response
     */
    public function preparedArrets($selected = null)
    {
        $selected = json_decode(Input::get('selected'));

        $selected_cats  = $this->custom->getPrefixString($selected, 'cat-');
        $selected_annee = $this->custom->getPrefixString($selected, 'year-');
        $selected_annee = (isset($selected_annee[0]) ? $selected_annee[0] : null );

        $arrets   = $this->arret->getAll(195,$selected_annee);

        $prepared = $arrets->filter(function($arret) use ($selected_cats,$selected_annee)
        {
            // format the title with the date
            setlocale(LC_ALL, 'fr_FR');
            $arret->setAttribute('humanTitle',$arret->reference.' du '.$arret->pub_date->formatLocalized('%d %B %Y'));
            $arret->setAttribute('parsedText',$arret->pub_text);

            // categories for isotope
            if(!$arret->arrets_categories->isEmpty())
            {
                foreach($arret->arrets_categories as $cat){ $cats[] = 'cat-'.$cat->id; }

                $cats[]  = 'year-'.$arret->pub_date->year;
                $cats    = implode(' ',$cats);
                $cats_id = $arret->arrets_categories->lists('id');

                $arret->setAttribute('allcats',$cats);

                if( (!empty($selected_cats) && $this->custom->compare($selected_cats, $cats_id) ) || empty($selected_cats) )
                {
                    if( (isset($selected_annee) && ($selected_annee == $arret->pub_date->year) ) || !$selected_annee )
                    {
                        return $arret;
                    }
                }
            }
            else
            {
                if( (isset($selected_annee) && ($selected_annee == $arret->pub_date->year) ) || !$selected_annee )
                {
                    $cats[]  = 'year-'.$arret->pub_date->year;
                    $arret->setAttribute('allcats',$cats);

                    return $arret;
                }
            }
        });

        $prepared->sortBy('id');
        $prepared->values();

        return @json_encode($prepared);
    }

    /**
     * Return response arrets prepared for filtered
     *
     * @return response
     */
    public function preparedAnnees()
    {
        $arrets   = $this->arret->getAll(195);
        $prepared = $arrets->lists('pub_date');

        foreach($prepared as $arret)
        {
            $years[] = $arret->year;
        }

        $years = array_reverse(array_unique(array_values($years)));

        foreach($years as $id => $year)
        {
            $new = array('id' => $id , 'year' => $year , 'checked' => false);
            $allyears[] = $new;
        }

        return Response::json( $allyears, 200 );
    }

    public function prepareCampagne($id){

        $content  = $this->content->getByCampagne($id);

        $campagne = $content->map(function($item)
        {
            if ($item->arret_id > 0)
            {
                $arret = $this->arret->find($item->arret_id);
                $arret->setAttribute('type',$item->type);
                $arret->setAttribute('rangItem',$item->rang);
                $arret->setAttribute('idItem',$item->id);
                return $arret;
            }
            else
            {
                $item->setAttribute('rangItem',$item->rang);
                $item->setAttribute('idItem',$item->id);
                return $item;
            }
        });

        return $campagne;
    }

}
