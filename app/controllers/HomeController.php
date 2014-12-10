<?php

use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;
use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Service\Worker\ContentWorker;
use Laracasts\Commander\CommanderTrait;
use Droit\Command\MessageSendCommand;

class HomeController extends BaseController {

    use CommanderTrait;

    protected $arret;
    protected $categorie;
    protected $campagne;
    protected $content;
    protected $worker;
    protected $custom;

    public function __construct( ArretInterface $arret, CategorieInterface $categorie, NewsletterCampagneInterface $campagne, ContentWorker $content , CampagneInterface $worker )
    {
        $this->arret      = $arret;

        $this->categorie  = $categorie;

        $this->campagne   = $campagne;

        $this->content    = $content;

        $this->worker     = $worker;

        $this->custom     = new \Custom;

        $arrets = $this->arret->getPaginate(195,15);
        $latest = $arrets->take(3);

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

    public function sendMessage(){

        $this->execute('Droit\Command\MessageSendCommand');

        return Redirect::to('/')->with(array('status' => 'success', 'message' => '<strong>Merci pour votre message</strong><br/>Nous vous contacterons dès que possible.'));

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

        \Cache::forget('annees');
        \Cache::forget('arrets');
        \Cache::forget('analyses');

        $arrets = \Cache::rememberForever('arrets', function()
        {
            return $this->content->preparedArrets();
        });

        $analyses = \Cache::rememberForever('analyses', function()
        {
            return $this->content->preparedAnalyses();
        });

        $annees = \Cache::rememberForever('annees', function()
        {
            return $this->content->preparedAnnees();
        });

        return View::make('jurisprudence')->with(array( 'arrets' => $arrets, 'analyses' => $analyses, 'annees' => $annees , 'required' => $required ));
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

        $listCampagnes  = $this->campagne->getAllSent();
        $campagne       = $this->worker->getCampagne($newsletter);
        $newsletter     = $this->worker->findCampagneById($newsletter);

        return View::make('newsletter')->with(array( 'listCampagnes' => $listCampagnes , 'campagne' => $campagne , 'newsletter' => $newsletter ));
    }

    /*
     * TEST TEST TEST TEST!!!!
     * Only for testing and convert categories and arrets/analyses
     * TEST TEST TEST TEST!!!!
     * */
    public function convert()
    {
        return View::make('test');
    }

}
