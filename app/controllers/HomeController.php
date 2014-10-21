<?php

use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;

class HomeController extends BaseController {

    protected $arret;

    protected $categorie;

    protected $custom;

    public function __construct( ArretInterface $arret, CategorieInterface $categorie )
    {
        $this->arret     = $arret;

        $this->categorie = $categorie;

        $this->custom    = new \Custom;
    }

	public function showWelcome()
	{
		return View::make('hello');
	}

    public function contact()
    {
        return View::make('contact');
    }

    public function recueil()
    {
        return View::make('recueil');
    }

    /**
     * Display a listing of the resource.
     * GET /arret
     *
     * @return Response
     */
    public function post()
    {
        $arrets = $this->arret->getPaginate(195,15);
        $latest = $arrets->take(5);

        $required = true;

        $categories = $this->categorie->getAll(195);

        return View::make('arrets.index')->with(array( 'arrets' => $arrets , 'categories' => $categories , 'latest' => $latest , 'required' => $required ));
    }

}
