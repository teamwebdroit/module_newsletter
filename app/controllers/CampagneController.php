<?php

use Laracasts\Commander\CommanderTrait;
use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;
use Droit\Newsletter\Repo\NewsletterTypesInterface;
use Droit\Content\Repo\ContentInterface;
use Droit\Content\Repo\GroupeInterface;

use Droit\Command\CreateCampagneCommand;

class CampagneController extends BaseController {

    use CommanderTrait;

    protected $content;
    protected $worker;
    protected $types;
    protected $campagne;
    protected $custom;
    protected $arrets;
    protected $groupe;

    /* Inject dependencies */
    public function __construct( ContentInterface $contentSite, NewsletterContentInterface $content, CampagneInterface $worker, NewsletterTypesInterface $types, NewsletterCampagneInterface $campagne, GroupeInterface $groupe)
    {
        $this->beforeFilter('csrf', array('only' => array('store','update')));

        $this->content      = $content;
        $this->contentSite  = $contentSite;
        $this->worker       = $worker;
        $this->types        = $types;
        $this->campagne     = $campagne;
        $this->groupe       = $groupe;
        $this->arrets       = new \Droit\Content\Worker\ArretWorker();
        $this->custom       = new \Custom;

        $pub           = $this->contentSite->findyByType('pub');
        $soutiens      = $this->contentSite->findyByType('soutien');
        $allcategories = $this->worker->getCategoriesArrets();
        $imgcategories = $this->worker->getCategoriesImagesArrets();

        View::share('pageTitle', 'Campagnes');
        View::share('pub', $pub);
        View::share('soutiens', $soutiens);
        View::share('allcategories', $allcategories);
        View::share('imgcategories', $imgcategories);
    }

    public function index()
    {
        $campagnes = $this->campagne->getAll();

        return View::make('newsletter.index')->with( array('campagnes' => $campagnes) );
    }

    /**
     * Create form for a new campagne
     * GET /admin/campagne/create
     *
     * @return Response
     */
    public function create()
    {
        return View::make('newsletter.create');
    }

    /**
     * Store a newly created campagne and sync to service.
     * POST /admin/campagne
     *
     * @return Response
     */
    public function store()
    {
        $campagne = $this->execute('Droit\Command\CreateCampagneCommand');

        return Redirect::to('admin/campagne/'.$campagne->id)->with( array('status' => 'success' , 'message' => 'Campagne crée') );
    }

    /**
     * Display the build of campagne in admin
     * GET /admin/campagne/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $blocs       = $this->types->getAll();
        $infos       = $this->campagne->find($id);
        $campagne    = $this->worker->findCampagneById($id);

        return View::make('newsletter.show')->with(array( 'isNewsletter' => true , 'campagne' => $campagne , 'infos' => $infos, 'blocs' => $blocs));
    }

    /**
     * Show the form for editing the campagne.
     * GET /admin/campagne/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $campagne = $this->campagne->find($id);

        return View::make('newsletter.edit')->with(array( 'campagne' => $campagne ));
    }

    public function simple($id){

        return $this->campagne->find($id);
    }

    /**
     * View in browser of campagne
     * GET /campagne/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function view($id){

        /*
         * Urls
        */
        $unsubscribe  = url('/unsubscribe');
        $browser      = url('/campagne/'.$id);

        $infos    = $this->campagne->find($id);
        $campagne = $this->worker->findCampagneById($id);

        return View::make('newsletter.view')->with(array('content' => $campagne , 'infos' => $infos , 'unsubscribe' => $unsubscribe , 'browser' => $browser));
    }

    /**
     * Update the campagne infos.
     * PUT /admin/campagne/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        // Data array
        $data['id']            = $id;
        $data['sujet']         = Input::get('sujet');
        $data['auteurs']       = Input::get('auteurs');
        $data['newsletter_id'] = 1;

        $campagne = $this->campagne->update( $data );

        return Redirect::to('admin/campagne/'.$campagne->id)->with( array('status' => 'success' , 'message' => 'Campagne éditée') );
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /admin/campagne/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->campagne->delete($id);

        return Redirect::back()->with(array('status' => 'success', 'message' => 'Campagne supprimée' ));
    }

    /**
     * Unsubcribe page newsletter
     * Get /unsubscribe/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function unsubscribe(){

        return View::make('unsubscribe');
    }

    /**
     * Add bloc to newsletter
     * POST data
     * @return Response
     */
    public function addContent(){

        $data = Input::all();

        $campagne = $data['campagne'];

        /* retrive type from database to set it right in content */
        $type = $data['type_id'];
        $rang = $this->content->getRang($campagne);
        $rang = ($rang ? $rang : 0);

        $lien         = (isset($data['lien']) ? $this->custom->sanitizeUrl($data['lien']) : null);
        $categorie_id = (isset($data['categorie_id']) ? $data['categorie_id'] : 0);

        if($type == 7)
        {
            $arrets = $this->custom->prepareCategories($data['arrets']);
            $groupe = $this->groupe->create(array('categorie_id' => $categorie_id));
            $groupe_id = $groupe->id;
            $groupe = $this->groupe->find($groupe_id);
            $groupe->arrets_groupes()->sync($arrets);
        }

        // image resize

        $image = (isset($data['image']) ? $data['image'] : null);

        $this->custom->resizeImage($image,$type);

        $new = array(
            'type_id'                => $type,
            'titre'                  => (isset($data['titre']) ? $data['titre'] : null),
            'contenu'                => (isset($data['contenu']) ? $data['contenu'] : null),
            'image'                  => $image,
            'lien'                   => $lien,
            'arret_id'               => (isset($data['arret_id']) ? $data['arret_id'] : 0),
            'groupe_id'              => (isset($groupe_id) && !empty($groupe_id) ? $groupe_id : 0),
            'categorie_id'           => 0,
            'newsletter_campagne_id' => $campagne,
            'rang'                   => $rang
        );

        $contents = $this->content->create($new);

        if($contents)
        {
            return Redirect::to('admin/campagne/'.$campagne.'#componant')->with(array('status' => 'success', 'message' => 'Bloc ajouté' ));
        }

        return Redirect::back()->with(array('status' => 'error', 'message' => 'Problème avec l\'ajout' ));

    }

    /**
     * Edit bloc from newsletter
     * POST data
     * @return Response
     */
    public function editContent(){

        $data = Input::all();

        $new  = array('id' => $data['id']);

        if(!empty($data))
        {
            foreach($data as $key => $input)
            {
                if(!empty($input)){
                    $new[$key] = $input;
                }
            }
        }

        $contents = $this->content->update($new);

        if($contents)
        {
            return Redirect::back()->with(array('status' => 'success', 'message' => 'Bloc édité' ));
        }

        return Redirect::back()->with(array('status' => 'error', 'message' => 'Problème avec l\'édition' ));

    }

    /**
     * Sorting bloc newsletter
     * POST remove
     * AJAX
     * @return Response
     */
    public function sorting(){

        $data = Input::all();

        $contents = $this->content->updateSorting($data['bloc_rang']);

        print_r($data);

    }

    /**
     * Sorting bloc newsletter
     * POST remove
     * AJAX
     * @return Response
     */
    public function sortingGroup(){

        $data = Input::all();

        $groupe_rang = $data['groupe_rang'];
        $groupe_id   = $data['groupe_id'];

        $arrets = $this->custom->prepareCategories($groupe_rang);

        $groupe = $this->groupe->find($groupe_id);
        $groupe->arrets_groupes()->sync($arrets);

        print_r($groupe->arrets_groupes);

    }


    /**
     * Remove bloc from newsletter
     * POST remove
     * AJAX
     * @return Response
     */
    public function remove(){

        $this->content->delete(Input::get('id'));

        return 'ok';
    }

}
