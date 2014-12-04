<?php

use Droit\Service\Worker\UploadInterface;
use Droit\Service\Worker\FileWorker;

class FileController extends \BaseController {

    protected $upload;
    protected $worker;

    public function __construct( UploadInterface $upload, FileWorker $worker )
    {
        $this->upload = $upload;
        $this->worker = $worker;
    }

	/**
	 * Display a listing of the resource.
	 * GET /file
	 *
	 * @return Response
	 */
	public function index()
	{
        $test = $this->worker->used( 'ass-maladie.jpg' );

        return View::make('admin.files.index')->with(array('test' => $test , 'isFileManager' => true));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /file/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /file
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /file/{id}
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
	 * GET /file/{id}/edit
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
	 * PUT /file/{id}
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
	 * DELETE /file
	 *
	 * @return Response
	 */
	public function destroy()
	{
        $filename = public_path().'/'.Input::get('file');

        if( \File::delete($filename) )
        {
            return Redirect::back()->with( array('status' => 'success' , 'message' => 'Fichier supprimé') );
        }
        else
        {
            return Redirect::back()->with( array('status' => 'danger' , 'message' => 'Problème avec la suppression du fichier') );
        }
	}

    /**
     * Scan files directory and return json
     * GET /file/scan
     *
     * @return json
     */
    public function scan(){

        return array(
            "name" => "files",
            "type" => "folder",
            "path" => 'files',
            "items" => $this->upload->scan('files')
        );

    }

    /**
     * Test if images linked to categories, arrets or newsletter content
     *
     * @return array
     */
    public function imageIsUsed(){

        return Response::json( $this->worker->used(Input::get('file')) , 200 );
    }

    /**
     * Add new folder
     *
     * @return array
     */
    public function addFolder(){

        if( \File::makeDirectory( Input::get('path').'/'.Input::get('folder') , 0775, true) )
        {
            return Redirect::back()->with( array('status' => 'success' , 'message' => 'Dossier crée') );
        }

        return Redirect::back()->with( array('status' => 'danger' , 'message' => 'Problème avec la création du dossier') );

    }

}