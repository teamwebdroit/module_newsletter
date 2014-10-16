<?php

use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;

class ArretController extends \BaseController {

    protected $arret;

    protected $categorie;

    protected $custom;

    public function __construct( ArretInterface $arret, CategorieInterface $categorie )
    {
        $this->arret     = $arret;

        $this->categorie = $categorie;

        $this->custom    = new \Custom;
    }

	/**
	 * Display a listing of the resource.
	 * GET /arret
	 *
	 * @return Response
	 */

    public function index()
    {
        $arrets = $this->arret->getPaginate(195,15);
        $latest = $arrets->take(5);

        $required = true;

        $categories = $this->categorie->getAll(195);

        return View::make('arrets.index')->with(array( 'arrets' => $arrets , 'categories' => $categories , 'latest' => $latest , 'required' => $required ));
    }

    /**
     * Display a list of arrets
     * GET /arret
     *
     * @return Response
     */

    public function listed()
    {
        $arrets = $this->arret->getAll(195);
        $categories = $this->categorie->getAll(195);

        $required = true;

        return View::make('arrets.list')->with(array( 'arrets' => $arrets , 'categories' => $categories  , 'required' => $required ));
    }

    /**
     * Return one arret by id
     *
     * @return json
     */
    public function show($id)
    {
        $arret = $this->arret->find($id);

        return View::make('newsletter.arret')->with(array( 'arret' => $arret));
    }

    /**
     * Return response arrets
     *
     * @return response
    */
    public function arrets()
    {
        $arrets = $this->arret->getAll(195);

        return Response::json( $arrets, 200 );
    }

    /**
     * Return response arrets prepared for filtered
     *
     * @return response
     */
    public function preparedArrets($selected = null)
    {
        $selected = json_decode(Input::get('selected'));
        $arrets   = $this->arret->getAll(195);

        $prepared = $arrets->filter(function($arret) use ($selected)
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

                if( (isset($selected) && $this->custom->compare($selected, $cats_id)) || !isset($selected) )
                {
                    return $arret;
                }
            }
            else
            {
                $cats[]  = 'year-'.$arret->pub_date->year;
                $arret->setAttribute('allcats',$cats);
                return $arret;
            }
        });

    /*
    foreach($prepared as $arret)
      {
           echo '<pre>';

               $prepared->values();
               print_r($prepared->toarray());

           echo '</pre>';
      }
    */
        $prepared->sortBy('id');
        $prepared->values();
        return Response::json( $prepared, 200 );
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
            $new = array('id' => $id , 'year' =>$year );
            $allyears[] = $new;
        }

        return Response::json( $allyears, 200 );
    }


    /**
     * Return response categories
     *
     * @return response
     */
    public function categories()
    {
        $categories = $this->categorie->getAll(195);

        return Response::json( $categories, 200 );
    }

}