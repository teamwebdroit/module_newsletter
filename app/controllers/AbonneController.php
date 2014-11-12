<?php

use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Newsletter\Repo\NewsletterSubscriptionInterface;
use Laracasts\Validation\FormValidationException;
use Droit\Form\InscriptionValidation;

class AbonneController extends \BaseController {

    protected $abonne;
    protected $subscribe;
    protected $validator;

    public function __construct(NewsletterUserInterface $abonne, NewsletterSubscriptionInterface $subscribe, InscriptionValidation $validator)
    {
        $this->abonne    = $abonne;
        $this->subscribe = $subscribe;
        $this->validator = $validator;
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
        return View::make('abonnes.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /abonne
	 *
	 * @return Response
	 */
	public function store()
	{
        // Validate email
        $this->validator->validate( array('email' => Input::get('email')) );

        $abonne = $this->abonne->add( array('email' => Input::get('email')) );

        $this->subscribe->subscribe( array('user_id'=> $abonne->id, 'newsletter_id' => Input::get('newsletter_id')) );

        return Redirect::to('admin/abonne/'.$abonne->id)->with( array('status' => 'success' , 'message' => 'Abonné ajouté') );
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
        $abonne = $this->abonne->find($id);

        return View::make('abonnes.edit')->with(array( 'abonne' => $abonne ));
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
        $activation = Input::get('activation');
        $data['activated_at'] = ($activation ? true : false );

        $data['id']    = $id;
        $data['email'] = Input::get('email');

        $abonne = $this->abonne->update( $data );

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
		//
	}

}