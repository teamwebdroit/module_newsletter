<?php

use Droit\Content\Repo\ContentInterface;
use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;
use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Service\Worker\ContentWorker;
use Droit\Author\Repo\AuthorInterface;
use Laracasts\Commander\CommanderTrait;
use Droit\Command\MessageSendCommand;
use Droit\Service\Worker\ColloqueWorker;

class HomeController extends Controller
{

    use CommanderTrait;

    protected $content;
    protected $arret;
    protected $categorie;
    protected $campagne;
    protected $jurisprudence;
    protected $worker;
    protected $custom;
    protected $colloque;
    protected $author;

    public function __construct(
        ContentInterface $content,
        ArretInterface $arret,
        CategorieInterface $categorie,
        NewsletterCampagneInterface $campagne,
        ContentWorker $jurisprudence,
        CampagneInterface $worker,
        ColloqueWorker $colloque,
        AuthorInterface $author
    ) {
    
        $this->content        = $content;
        $this->arret          = $arret;
        $this->categorie      = $categorie;
        $this->author         = $author;
        $this->campagne       = $campagne;
        $this->jurisprudence  = $jurisprudence;
        $this->worker         = $worker;
        $this->colloque       = $colloque;
        $this->custom         = new \Custom;

        $include = $this->jurisprudence->showArrets();
        $latest  = $this->arret->getLatest($include);

        $categories    = $this->categorie->getAllOnSite(195);
        $allcategories = $this->worker->getCategoriesArrets();
        $pub           = $this->content->findyByType('pub');
        $soutiens      = $this->content->findyByType('soutien');

        View::share('pub', $pub);
        View::share('soutiens', $soutiens);
        View::share('latest', $latest);
        View::share('categories', $categories);
        View::share('allcategories', $allcategories);
    }

    public function index()
    {
        $homepage = $this->content->findyByPosition(array('home-bloc','home-colonne'));
        $homepage = $this->custom->prepareBlocsHomepage($homepage);

        return View::make('index')->with(array('homepage' => $homepage));
    }

    public function colloque()
    {
        $colloques = $this->colloque->getColloques();
        $archives  = $this->colloque->getArchives();

        return View::make('colloque')->with(array('colloques' => $colloques, 'archives' => $archives ));
    }

    public function auteur()
    {
        $auteurs = $this->author->getAll();

        return View::make('auteur')->with(array('auteurs' => $auteurs));
    }

    public function contact()
    {
        return View::make('contact');
    }

    public function sendMessage()
    {

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
        \Cache::forget('annees');
        \Cache::forget('arrets');
        \Cache::forget('analyses');

        $arrets = \Cache::rememberForever('arrets', function () {
        
            return $this->jurisprudence->preparedArrets();
        });

        $analyses = \Cache::rememberForever('analyses', function () {
        
            return $this->jurisprudence->preparedAnalyses();
        });

        $annees = \Cache::rememberForever('annees', function () {
        
            return $this->jurisprudence->preparedAnnees();
        });

        return View::make('jurisprudence')->with(array('arrets' => $arrets, 'analyses' => $analyses, 'annees' => $annees ));
    }

    /**
     * Display a listing of the resource.
     * GET /newsletter
     *
     * @return Response
     */
    public function newsletters($id = null)
    {

        if ($id) {
            $newsletter_id = $id;
        } else {
            $newsletter    = $this->campagne->getLastCampagne();
            $newsletter_id = (!$newsletter->isEmpty() ? $newsletter->first()->id : null);
        }

        if (!empty($newsletter_id)) {
            $campagne       = $this->worker->getCampagne($newsletter_id);
            $newsletter     = $this->worker->findCampagneById($newsletter_id);
        } else {
            $campagne   = [];
            $newsletter = [];
        }

        $listCampagnes  = $this->campagne->getLastCampagne();

        return View::make('campagne')->with(array( 'listCampagnes' => $listCampagnes , 'campagne' => $campagne , 'newsletter' => $newsletter ));
    }
}
