<?php

use Droit\Newsletter\Repo\NewsletterUserInterface;

class AbonneController extends \BaseController {

    protected $abonne;

    public function __construct(NewsletterUserInterface $abonne)
    {
        $this->abonne = $abonne;
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
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /abonne
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /abonne/{id}
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
	 * GET /abonne/{id}/edit
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
	 * PUT /abonne/{id}
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