<?php

use Droit\Content\Repo\ContentInterface;
use Droit\Service\Worker\UploadInterface;

class ContentController extends \BaseController
{

    protected $content;
    protected $upload;
    protected $custom;

    public function __construct(ContentInterface $content, UploadInterface $upload)
    {
        $this->beforeFilter('csrf', array('only' => array('store','update')));

        $this->content   = $content;
        $this->upload    = $upload;
        $this->custom    = new \Custom;

        View::share('pageTitle', 'Contenus');
        View::share('positions', array('sidebar' => 'Barre latérale', 'home-bloc' => 'Accueil bloc plein', 'home-colonne' => 'Accueil bloc colonne'));
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

        return view('admin.content.index')->with(array( 'content' => $content ));
    }

    /**
     * Show the form for creating a new resource.
     * GET /content/create
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.content.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /content
     *
     * @return Response
     */
    public function store()
    {
        $_file = Input::file('file', null);

        // Files upload
        if (isset($_file)) {
            $file = $this->upload->upload(Input::file('file'), 'files');
        }

        // Data array
        $data['titre']    = Input::get('titre');
        $data['contenu']  = Input::get('contenu');
        $data['url']      = Input::get('url');
        $data['slug']     = Input::get('slug');
        $data['type']     = Input::get('type');
        $data['position'] = Input::get('position');
        $data['rang']     = Input::get('rang');
        $data['image']    = (isset($file) && !empty($file) ? $file['name'] : null);

        $content = $this->content->create($data);

        return redirect('admin/contenu/'.$content->id)->with(array('status' => 'success' , 'message' => 'Contenu crée'));
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
        $contenu = $this->content->find($id);

        return view('admin.content.show')->with(array( 'contenu' => $contenu ));
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

        $_file = Input::file('file', null);

        // Files upload
        if (isset($_file)) {
            $file = $this->upload->upload(Input::file('file'), 'files');
        }

        // Data array
        $data['id']       = $id;
        $data['titre']    = Input::get('titre');
        $data['contenu']  = Input::get('contenu');
        $data['url']      = Input::get('url');
        $data['slug']     = Input::get('slug');
        $data['type']     = Input::get('type');
        $data['position'] = Input::get('position');
        $data['rang']     = Input::get('rang');
        $data['image']    = (isset($file) && !empty($file) ? $file['name'] : null);

        $content = $this->content->update($data);

        return redirect('admin/contenu/'.$content->id)->with(array('status' => 'success' , 'message' => 'Contenu mis à jour'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /content
     *
     * @return Response
     */
    public function destroy($id)
    {
        $this->content->delete($id);

        return Redirect::back()->with(array('status' => 'success', 'message' => 'Contenu supprimée' ));
    }
}
