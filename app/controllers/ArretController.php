<?php

use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;

class ArretController extends \BaseController {

    protected $arret;

    protected $categorie;

    public function __construct( ArretInterface $arret, CategorieInterface $categorie )
    {
        $this->arret  = $arret;

        $this->categorie  = $categorie;
    }

	/**
	 * Display a listing of the resource.
	 * GET /arret
	 *
	 * @return Response
	 */

    public function index()
    {
        $arrets = $this->arret->getAll(195);
        $latest = $arrets->take(5);

        $categories = $this->categorie->getAll(195);

        return View::make('arrets.index')->with(array( 'arrets' => $arrets , 'categories' => $categories , 'latest' => $latest ));
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

}