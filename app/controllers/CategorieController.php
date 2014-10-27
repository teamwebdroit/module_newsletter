<?php

use Droit\Categorie\Repo\CategorieInterface;

class CategorieController extends \BaseController {

    protected $categorie;

    protected $custom;

    public function __construct( CategorieInterface $categorie )
    {

        $this->categorie = $categorie;

        $this->custom    = new \Custom;
    }

    /**
     * Show the form for creating a new resource.
     * GET /adminconotroller/create
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->categorie->getAll(195);

        return View::make('admin.index')->with(array( 'categories' => $categories));
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /categorie/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /categorie
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /categorie/{id}
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
	 * GET /categorie/{id}/edit
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
	 * PUT /categorie/{id}
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
	 * DELETE /categorie/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

    /**
     * For AJAX
     * Return response categories
     *
     * @return response
     */
    public function categories()
    {
        $categories = $this->categorie->getAll(195);

        return Response::json( $categories, 200 );
    }

}