<?php

use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Newsletter\Repo\NewsletterSubscriptionInterface;
use Droit\Newsletter\Repo\NewsletterInterface;
use Laracasts\Validation\FormValidationException;
use Droit\Form\AddUserValidation;


class AbonneController extends \BaseController {

    protected $abonne;
    protected $newsletter;
    protected $subscribe;
    protected $validator;

    public function __construct(NewsletterUserInterface $abonne, NewsletterInterface $newsletter, NewsletterSubscriptionInterface $subscribe, AddUserValidation $validator)
    {
        $this->abonne     = $abonne;
        $this->newsletter = $newsletter;
        $this->subscribe  = $subscribe;
        $this->validator  = $validator;
    }

	/**
	 * Display a listing of the resource.
	 * GET /abonne
	 *
	 * @return Response
	 */
	public function index()
	{
        $abonnes = $this->abonne->getAll();

        return View::make('abonnes.index')->with( array('abonnes' => $abonnes) );
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

        return View::make('abonnes.create')->with(array( 'newsletter' => $newsletter ));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /abonne
	 *
	 * @return Response
	 */
	public function store()
	{
        $activation    = Input::get('activation');
        $newsletter_id = Input::get('newsletter_id');

        $activated_at  = ($activation ? true : false );
        $newsletter_id = ( $newsletter_id ? Input::get('newsletter_id') : array() );

        // Validate email
        $this->validator->validate( array('email' => Input::get('email')) );

        $abonne = $this->abonne->add( array('email' => Input::get('email'), 'activated_at' => $activated_at ) );
        $abonne->newsletter()->sync($newsletter_id);

        return Redirect::to('admin/abonne')->with( array('status' => 'success' , 'message' => 'Abonné ajouté') );
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

        return View::make('abonnes.edit')->with(array( 'abonne' => $abonne , 'newsletter' => $newsletter ));
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
        $activation    = Input::get('activation');
        $newsletter_id = Input::get('newsletter_id');

        $data['activated_at'] = ($activation ? true : false );
        $newsletter_id = ( $newsletter_id ? Input::get('newsletter_id') : array() );

        $data['id']    = $id;
        $data['email'] = Input::get('email');

        $abonne = $this->abonne->update( $data );

        $abonne->newsletter()->sync($newsletter_id);

        return Redirect::to('admin/abonne/'.$abonne->id.'/edit')->with( array('status' => 'success' , 'message' => 'Abonné édité') );
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /abonne/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $this->abonne->delete($id);

        return Redirect::back()->with(array('status' => 'success', 'message' => 'Abonné supprimé' ));
	}

}