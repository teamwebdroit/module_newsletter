<?php

use Laracasts\Commander\CommanderTrait;
use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Newsletter\Repo\NewsletterInterface;

use Droit\Command\AdminSubscribeCommandHandler;
use Droit\Command\UnsubscribeCommand;

class AbonneController extends \BaseController
{

    use CommanderTrait;

    protected $abonne;
    protected $newsletter;

    public function __construct(NewsletterUserInterface $abonne, NewsletterInterface $newsletter)
    {
        $this->abonne     = $abonne;
        $this->newsletter = $newsletter;

        View::share('pageTitle', 'Abonnés');
    }

    /**
     * Display a listing of the resource.
     * GET /abonne
     *
     * @return Response
     */
    public function index()
    {
        //$abonnes = $this->abonne->getAll();

        return view('admin.abonnes.index');
    }

    /**
     * Display a listing of tabonnes for ajax
     * GET /abonne/getAllAbos
     *
     * @return Response
     */
    public function getAllAbos()
    {
        $sSearch = Input::get('sSearch');
        $sSearch = ($sSearch && !empty($sSearch) ? $sSearch : null);

        $sEcho          = Input::get('sEcho');
        $iDisplayStart  = Input::get('iDisplayStart');
        $iDisplayLength = Input::get('iDisplayLength');
        $iSortCol_0     = Input::get('iSortCol_0');
        $sSortDir_0     = Input::get('sSortDir_0');

        return $this->abonne->get_ajax($sEcho, $iDisplayStart, $iDisplayLength, $iSortCol_0, $sSortDir_0, $sSearch);

    }

    /**
     * Show the form for creating a new resource.
     * GET /abonne/create
     *
     * @return Response
     */
    public function create()
    {
        $newsletter = $this->newsletter->getAll();

        return view('admin.abonnes.create')->with(array( 'newsletter' => $newsletter ));
    }

    /**
     * Store a newly created resource in storage.
     * POST /abonne
     *
     * @return Response
     */
    public function store()
    {
        $newsletter_id = (Input::get('newsletter_id') ? Input::get('newsletter_id') : array() );

        $command = array(
            'email'         => Input::get('email'),
            'newsletter_id' => $newsletter_id,
            'activation'    => Input::get('activation')
        );

        $this->execute('Droit\Command\AdminSubscribeCommand', $command);

        return redirect('admin/abonne')->with(array('status' => 'success' , 'message' => 'Abonné ajouté'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /abonne/{id}/edit
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $abonne     = $this->abonne->find($id);
        $newsletter = $this->newsletter->getAll();

        return view('admin.abonnes.edit')->with(array( 'abonne' => $abonne , 'newsletter' => $newsletter ));
    }

    /**
     * Update the specified resource in storage.
     * PUT /abonne/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {

        $newsletter_id = (Input::get('newsletter_id') ? Input::get('newsletter_id') : array() );

        $command = array(
            'id'            => Input::get('id') ,
            'email'         => Input::get('email'),
            'newsletter_id' => $newsletter_id,
            'activation'    => Input::get('activation')
        );

        $this->execute('Droit\Command\UpdateSubscriberCommand', $command);

        return redirect('admin/abonne/'.$id.'/edit')->with(array('status' => 'success' , 'message' => 'Abonné édité'));

    }

    /**
     * Remove the specified resource from storage.
     * DELETE /abonne/{id}
     *
     * @param  int  $email
     * @return Response
     */
    public function destroy($email)
    {
        $this->execute('Droit\Command\UnsubscribeCommand', array('email' => $email, 'newsletter_id' => array(1)));

        return Redirect::back()->with(array('status' => 'success', 'message' => 'Abonné supprimé' ));
    }
}
