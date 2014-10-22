<?php

use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;
use Droit\Newsletter\Worker\CampagneInterface;

class HomeController extends BaseController {

    protected $arret;

    protected $categorie;

    protected $campagne;

    protected $worker;

    protected $custom;

    public function __construct( ArretInterface $arret, CategorieInterface $categorie, NewsletterCampagneInterface $campagne , CampagneInterface $worker )
    {
        $this->arret     = $arret;

        $this->categorie = $categorie;

        $this->campagne  = $campagne;

        $this->worker    = $worker;

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
        $listCampagnes  = $this->campagne->getAll();
        $campagne       = $this->worker->getCampagne(1);
        $newsletter     = $this->worker->findCampagneById(1);

        return View::make('newsletter')->with(array( 'listCampagnes' => $listCampagnes , 'campagne' => $campagne , 'newsletter' => $newsletter ));
    }

}
