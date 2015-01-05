<?php

use Droit\Content\Repo\ContentInterface;

class ContentController extends \BaseController {

    protected $content;
    protected $custom;

    public function __construct(ContentInterface $content)
    {
        $this->content   = $content;
        $this->custom    = new \Custom;
    }

	/**
	 * Display a listing of the resource.
	 * GET /content
	 *
	 * @return Response
	 */
	public function index()
	{
        $content  = $this->content->getAll();

        return View::make('admin.content.index')->with(array( 'content' => $content ));

	}

    /**
     * Show the form for creating a new resource.
     * GET /content/create
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     * POST /content
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     * GET /content/{id}
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
     * GET /content/{id}/edit
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
     * PUT /content/{id}
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
     * DELETE /content
     *
     * @return Response
     */
    public function destroy($id)
    {

    }

}