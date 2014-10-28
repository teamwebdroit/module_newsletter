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

    public function index()
    {
        return View::make('index');
    }

    public function contact()
    {
        return View::make('contact');
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
    public function newsletters($id = null)
    {
        $newsletter     = ($id ? $id : $this->campagne->getLastCampagne()->id );

        $listCampagnes  = $this->campagne->getAll();
        $campagne       = $this->worker->getCampagne($newsletter);
        $newsletter     = $this->worker->findCampagneById($newsletter);

        return View::make('newsletter')->with(array( 'listCampagnes' => $listCampagnes , 'campagne' => $campagne , 'newsletter' => $newsletter ));
    }

    /*
     * Only for testing and convert categories and arrets/analyses
     * */
    public function convert()
    {
        return View::make('test');
    }

}
