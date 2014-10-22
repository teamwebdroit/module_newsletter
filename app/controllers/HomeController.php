<?php

use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;

class HomeController extends BaseController {

    protected $arret;

    protected $categorie;

    protected $campagne;

    protected $custom;

    public function __construct( ArretInterface $arret, CategorieInterface $categorie, NewsletterCampagneInterface $campagne )
    {
        $this->arret     = $arret;

        $this->categorie = $categorie;

        $this->campagne  = $campagne;

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
     * GET /jurisprudence
     *
     * @return Response
     */
    public function jurisprudence()
    {
        $required = true;

        return View::make('jurisprudence')->with(array( 'required' => $required ));
    }

    /**
     * Display a listing of the resource.
     * GET /newsletter
     *
     * @return Response
     */
    public function newsletters()
    {
        $campagnes =  $this->campagne->getAll();

        return View::make('newsletter')->with(array( 'campagnes' => $campagnes  ));
    }

}
