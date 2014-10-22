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

        $arrets = $this->arret->getPaginate(195,15);
        $latest = $arrets->take(5);

        $categories = $this->categorie->getAll(195);

        View::share('arrets', $arrets);
        View::share('latest', $latest);
        View::share('categories', $categories);
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
        return View::make('index');
    }

    /**
     * Display a listing of the resource.
     * GET /arret
     *
     * @return Response
     */
    public function jurisprudence()
    {
        $required = true;

        return View::make('jurisprudence')->with(array( 'required' => $required ));
    }

}
