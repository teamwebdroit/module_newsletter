<?php

use Laracasts\Commander\CommanderTrait;
use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Content\Repo\ArretInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;
use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Newsletter\Repo\NewsletterTypesInterface;
use Droit\Command\CreateCampagneCommand;

class CampagneController extends BaseController {

    use CommanderTrait;

    protected $content;
    protected $arret;
    protected $types;
    protected $campagne;
    protected $worker;

    /* Inject dependencies */
    public function __construct( NewsletterContentInterface $content, ArretInterface $arret, NewsletterTypesInterface $types, NewsletterCampagneInterface $campagne, CampagneInterface $worker)
    {
        $this->content  = $content;
        $this->arret    = $arret;
        $this->types   = $types;
        $this->campagne = $campagne;
        $this->worker   = $worker;
    }

    public function index()
    {
        $campagnes = $this->campagne->getAll();

        return View::make('newsletter.index')->with( array('campagnes' => $campagnes) );
    }

    public function create()
    {
        return View::make('newsletter.create');
    }

    public function compose()
    {
        return View::make('newsletter.compose')->with(array( 'isNewsletter' => true ));
    }

    /**
     * Store a newly created resource in storage.
     * POST /campagne
     *
     * @return Response
     */
    public function store()
    {
        $campagne = $this->execute('Droit\Command\CreateCampagneCommand');

        return Redirect::to('admin/campagne/'.$campagne->id)->with( array('status' => 'success' , 'message' => 'Campagne crée') );
    }

    /**
     * Display the specified resource.
     * GET /campagne/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $blocs    = $this->types->getAll();
        $infos    = $this->campagne->find($id);
        $content  = $this->content->getByCampagne($id);

        $campagne = $content->map(function($item)
        {
            if ($item->arret_id > 0)
            {
                $arret = $this->arret->find($item->arret_id);
                $arret->setAttribute('type',$item->type);
                $arret->setAttribute('rangItem',$item->rang);
                $arret->setAttribute('idItem',$item->id);
                return $arret;
            }
            else
            {
                $item->setAttribute('rangItem',$item->rang);
                $item->setAttribute('idItem',$item->id);
                return $item;
            }
        });

        return View::make('newsletter.show')->with(array( 'isNewsletter' => true , 'campagne' => $campagne , 'infos' => $infos, 'blocs' => $blocs ));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /campagne/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $campagne = $this->campagne->find($id);

        return View::make('newsletter.edit')->with(array( 'campagne' => $campagne ));
    }

    public function view($id){

        /*
         * Urls
        */
        $unsubscribe  = url('/unsubscribe/'.$id);
        $browser      = url('/campagne/'.$id);

        $infos    = $this->campagne->find($id);
        $content  = $this->content->getByCampagne($id);

        $campagne = $content->map(function($item)
        {
            if ($item->arret_id > 0)
            {
                $arret = $this->arret->find($item->arret_id);
                $arret->setAttribute('type',$item->type);
                $arret->setAttribute('rangItem',$item->rang);
                $arret->setAttribute('idItem',$item->id);
                return $arret;
            }
            else
            {
                $item->setAttribute('rangItem',$item->rang);
                $item->setAttribute('idItem',$item->id);
                return $item;
            }
        });

        return View::make('newsletter.view')->with(array('content' => $campagne , 'infos' => $infos , 'unsubscribe' => $unsubscribe , 'browser' => $browser));
    }
    /**
     * Update the specified resource in storage.
     * PUT /campagne/{id}
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
     * DELETE /campagne/{id}
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
     * Unsubcribe from newsletter
     * Get /unsubscribe/{id}
     *
     * @param  int  $id
     * @return Response
     */

    public function unsubscribe($id){

        $campagne = $this->campagne->find($id);

        return View::make('unsubscribe')->with(array('campagne' => $campagne));
    }

}
