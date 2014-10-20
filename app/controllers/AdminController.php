<?php

use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;

class AdminController extends \BaseController {

    protected $arret;

    protected $categorie;

    public function __construct( ArretInterface $arret, CategorieInterface $categorie )
    {
        $this->arret     = $arret;

        $this->categorie = $categorie;

    }

	/**
	 * Display a listing of the resource.
	 * GET /adminconotroller
	 *
	 * @return Response
	 */
	public function index()
	{
        $arrets     = $this->arret->getAll(195);
        $categories = $this->categorie->getAll(195);

        return View::make('admin.index')->with(array('arrets' => $arrets , 'categories' => $categories));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /adminconotroller/create
	 *
	 * @return Response
	 */
	public function arret()
	{
        $arrets     = $this->arret->getAll(195);
        $categories = $this->categorie->getAll(195);

        return View::make('admin.index')->with(array('arrets' => $arrets , 'categories' => $categories));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /adminconotroller
	 *
	 * @return Response
	 */
	public function store()
	{
		//
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
		//
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