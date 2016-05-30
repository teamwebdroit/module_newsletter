<?php

use Droit\Categorie\Repo\CategorieInterface;
use Droit\Service\Worker\UploadInterface;

class CategorieController extends \BaseController {

    protected $categorie;
    protected $upload;
    protected $custom;

    public function __construct( CategorieInterface $categorie, UploadInterface $upload )
    {
        $this->beforeFilter('csrf', array('only' => array('store','update')));

        $this->categorie = $categorie;
        $this->upload    = $upload;
        $this->custom    = new \Custom;

        View::share('pageTitle', 'Catégories');
    }

    /**
     * Show the form for creating a new resource.
     * GET /admin/categorie/create
     *
     * @return Response
     */
    public function index()
    {
        $categories = $this->categorie->getAll(195);

        return View::make('admin.categories.index')->with(array( 'categories' => $categories));
    }

	/**
	 * Show the form for creating a new resource.
	 * GET /categorie/create
	 *
	 * @return Response
	 */
	public function create()
	{
        return View::make('admin.categories.create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /categorie
	 *
	 * @return Response
	 */
	public function store()
	{
        $_file = Input::file('file', null);

        // Files upload
        if( !isset($_file) )
        {
            return Redirect::back()->with( array('status' => 'danger' , 'message' => 'L\'image est requise') );
        }

        $file = $this->upload->upload( Input::file('file') , 'newsletter/pictos' , 'categorie');

        // Data array
        $data['title']      = Input::get('title');
        $data['ismain']     = (Input::get('ismain') ? 1 : 0);
        $data['hideOnSite'] = (Input::get('hideOnSite') ? 1 : 0);
        $data['user_id']    = Input::get('user_id');
        $data['pid']        = 195;
        $data['image']      = (isset($file) && !empty($file) ? $file['name'] : null);

        $categorie = $this->categorie->create( $data );

        return Redirect::to('admin/categorie/'.$categorie->id)->with( array('status' => 'success' , 'message' => 'Catégorie crée') );
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
        $categorie = $this->categorie->find($id);

        return View::make('admin.categories.show')->with(array( 'categorie' => $categorie));
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
        $_file = Input::file('file', null);

        // Files upload
        if( $_file )
        {
            $file = $this->upload->upload( Input::file('file') , 'newsletter/pictos' , 'categorie');
        }

        // Data array
        $data['id']         = $id;
        $data['title']      = Input::get('title');
        $data['ismain']     = (Input::get('ismain') ? 1 : 0);
        $data['hideOnSite'] = (Input::get('hideOnSite') ? 1 : 0);
        $data['image']      = (isset($file) && !empty($file) ? $file['name'] : null);

        $this->categorie->update( $data );

        return Redirect::to('admin/categorie/'.$id)->with( array('status' => 'success' , 'message' => 'Catégorie mise à jour') );
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
        $this->categorie->delete($id);

        return Redirect::back()->with(array('status' => 'success', 'message' => 'Catégorie supprimée' ));
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

    public function arretsExists(){

        $id = Input::get('id');

        $categorie = $this->categorie->find($id);

        $references = (!$categorie->categorie_arrets->isEmpty() ? $categorie->categorie_arrets->lists('reference') : null);

        return Response::json( $references, 200 );
    }

}