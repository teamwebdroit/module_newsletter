<?php

use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Content\Repo\ArretInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;

class CampagneController extends BaseController {

    protected $content;
    protected $arret;
    protected $campagne;

    /* Inject dependencies */
    public function __construct( NewsletterContentInterface $content, ArretInterface $arret, NewsletterCampagneInterface $campagne )
    {
        $this->content  = $content;
        $this->arret    = $arret;
        $this->campagne = $campagne;

        /*
         * Urls
        */
        $shared['unsuscribe']   = url('/');
        $shared['browser']      = url('/');

        View::share( $shared );
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
     * POST /adminconotroller
     *
     * @return Response
     */
    public function store()
    {
        // Data array
        $data['sujet']         = Input::get('sujet');
        $data['auteurs']       = Input::get('auteurs');
        $data['newsletter_id'] = 1;

        $campagne = $this->campagne->create( $data );

        return Redirect::to('admin/campagne/'.$campagne->id)->with( array('status' => 'success' , 'message' => 'Campagne crée') );
    }

    /**
     * Display the specified resource.
     * GET /adminconotroller/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $campagne = $this->campagne->find($id);

        return View::make('newsletter.show')->with(array( 'isNewsletter' => true , 'campagne' => $campagne ));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /adminconotroller/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    public function view($id){

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

        return View::make('newsletter.view')->with(array('content' => $campagne));
    }
    /**
     * Update the specified resource in storage.
     * PUT /adminconotroller/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /adminconotroller/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }


}
