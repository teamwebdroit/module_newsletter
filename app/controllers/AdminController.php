<?php

use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;
use Droit\Newsletter\Repo\NewsletterUserInterface;

class AdminController extends \BaseController {

    protected $arret;
    protected $abonne;
    protected $categorie;

    public function __construct( NewsletterUserInterface $abonne,ArretInterface $arret, CategorieInterface $categorie )
    {
        $this->arret     = $arret;
        $this->abonne    = $abonne;
        $this->categorie = $categorie;

        View::share('pageTitle', 'Administration');

    }

	/**
	 * Display a listing of the resource.
	 * GET /adminconotroller
	 *
	 * @return Response
	 */
	public function index()
	{
        $arrets     = $this->arret->getAll(195)->take(5);
        $categories = $this->categorie->getAll(195);
        $abonnes    = $this->abonne->getAll();

        return View::make('admin.index')->with(array('arrets' => $arrets , 'categories' => $categories , 'abonnes' => $abonnes ));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /adminconotroller/create
	 *
	 * @return Response
	 */
	public function arret()
	{
        $arrets     = $this->arret->getAll(195);
        $categories = $this->categorie->getAll(195);

        return View::make('admin.index')->with(array('arrets' => $arrets , 'categories' => $categories));
	}

}