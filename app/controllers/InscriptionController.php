<?php

use Droit\Newsletter\Repo\NewsletterUserInterface;

class InscriptionController extends \BaseController {

    protected $abo;

    public function __construct(NewsletterUserInterface $abo)
    {
        $this->abo = $abo;
    }

    /**
	 * Activate newsletter abo
	 * GET //activation
	 *
	 * @return Response
	 */
	public function activation($token)
	{
		if($this->abo->activate($token)){
            return Redirect::to('recueil')->with( array('status' => 'success' , 'message' => 'Merci pour votre inscription à la newsletter en droit du travail') );
        }
        else{
            throw new \Droit\Exceptions\TokenInscriptionException('Token mismatch', array());
        }


	}

	/**
	 * Show the form for creating a new resource.
	 * GET /inscription/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /inscription
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /inscription/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /inscription/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /inscription/{id}
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
	 * DELETE /inscription/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}