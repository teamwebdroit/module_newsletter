<?php

use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;
use Droit\Service\Worker\UploadInterface;

class ArretController extends \BaseController
{

    protected $arret;
    protected $categorie;
    protected $upload;
    protected $custom;

    public function __construct(ArretInterface $arret, CategorieInterface $categorie, UploadInterface $upload)
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

        $this->arret     = $arret;
        $this->categorie = $categorie;
        $this->upload    = $upload;
        $this->custom    = new \Custom;

        View::share('pageTitle', 'Arrêts');
    }

    /**
     * Display a listing of the resource.
     * GET /arret
     *
     * @return Response
     */

    public function index()
    {
        $arrets     = $this->arret->getAll(195);
        $categories = $this->categorie->getAll(195);
        setlocale(LC_ALL, 'fr_FR');

        return view('admin.arrets.index')->with(array( 'arrets' => $arrets , 'categories' => $categories ));
    }

    /**
     * Return one arret by id
     *
     * @return json
     */
    public function show($id)
    {

        $arret      = $this->arret->find($id);
        $categories = $this->categorie->getAll(195);

        return view('admin.arrets.show')->with(array( 'arret' => $arret, 'categories' => $categories ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $categories = $this->categorie->getAll(195);

        return view('admin.arrets.create')->with(array( 'categories' => $categories ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $_file = Input::file('file');

        // Files upload
        if ($_file && !empty($_file)) {
            $file = $this->upload->upload(Input::file('file'), 'files/arrets');
        }

        $cats = Input::get('categories');

        if (!empty($cats)) {
            $categories = $this->custom->prepareCategories($cats);
        } else {
            $categories = array();
        }

        // Data array
        $data = array(
            'pid'        => 195,
            'user_id'    => Input::get('user_id'),
            'reference'  => Input::get('reference'),
            'pub_date'   => Input::get('pub_date'),
            'abstract'   => Input::get('abstract'),
            'categories' => count($categories),
            'pub_text'   => Input::get('pub_text'),
            'dumois'     => Input::get('dumois')
        );

        // Attach file if any
        $data['file'] = (!empty($file) ? $file['name'] : '');

        // Create arret
        $arret = $this->arret->create($data);

        // Insert related categories
        $arret->arrets_categories()->sync($categories);

        return redirect('admin/arret/'.$arret->id)->with(array('status' => 'success' , 'message' => 'Arrêt crée'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function update()
    {
        $_file = Input::file('file');

        // Files upload
        if ($_file && !empty($_file)) {
            $file = $this->upload->upload(Input::file('file'), 'files/arrets');
        }

        $cats = Input::get('categories');

        if (!empty($cats)) {
            $categories = $this->custom->prepareCategories($cats);
        } else {
            $categories = array();
        }

        // Data array
        $data = array(
            'id'         => Input::get('id'),
            'reference'  => Input::get('reference'),
            'pub_date'   => Input::get('pub_date'),
            'abstract'   => Input::get('abstract'),
            'categories' => count($categories),
            'pub_text'   => Input::get('pub_text'),
            'dumois'     => Input::get('dumois')
        );

        // Attach file if any
        $data['file'] = (!empty($file) ? $file['name'] : null);

        // Create arret
        $arret = $this->arret->update($data);

        // Insert related categories
        $arret->arrets_categories()->sync($categories);

        return redirect('admin/arret/'.$arret->id)->with(array('status' => 'success' , 'message' => 'Arrêt mis à jour'));

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
        $this->arret->delete($id);

        return Redirect::back()->with(array('status' => 'success', 'message' => 'Arrêt supprimée' ));
    }


    /**
     * Return response arrets
     *
     * @return response
     */
    public function arrets()
    {
        $arrets = $this->arret->getAll(195);

        return Response::json($arrets, 200);
    }


    /**
     * Return one arret by id
     *
     * @return json
     */
    public function simple($id)
    {
        return $this->arret->find($id);
    }
}
