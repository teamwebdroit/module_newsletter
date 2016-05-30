<?php

use Droit\Content\Repo\AnalyseInterface;
use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;
use Droit\Service\Worker\UploadInterface;
use Droit\Author\Repo\AuthorInterface;

class AnalyseController extends \BaseController
{

    protected $analyse;
    protected $author;
    protected $arret;
    protected $categorie;
    protected $upload;
    protected $custom;

    public function __construct(AuthorInterface $author, AnalyseInterface $analyse, ArretInterface $arret, CategorieInterface $categorie, UploadInterface $upload)
    {
        $this->beforeFilter('csrf', array('on' => 'post'));

        $this->author    = $author;
        $this->analyse   = $analyse;
        $this->arret     = $arret;
        $this->categorie = $categorie;
        $this->upload    = $upload;
        $this->custom    = new \Custom;

        View::share('pageTitle', 'Analyses');
    }

    /**
     * Display a listing of the resource.
     * GET /analyse
     *
     * @return Response
     */

    public function index()
    {
        setlocale(LC_ALL, 'fr_FR');

        $analyses   = $this->analyse->getAll();
        $categories = $this->categorie->getAll(195);

        return View::make('admin.analyses.index')->with(array( 'analyses' => $analyses , 'categories' => $categories ));
    }

    /**
     * Return one analyse by id
     *
     * @return json
     */
    public function show($id)
    {

        $arrets     = $this->arret->getAll(195);
        $analyse    = $this->analyse->find($id);
        $categories = $this->categorie->getAll(195);
        $auteurs    = $this->author->getAll();

        return View::make('admin.analyses.show')->with(array( 'analyse' => $analyse, 'arrets' => $arrets, 'categories' => $categories, 'auteurs' => $auteurs ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $arrets     = $this->arret->getAll(195);
        $categories = $this->categorie->getAll(195);
        $auteurs    = $this->author->getAll();

        return View::make('admin.analyses.create')->with(array( 'arrets' => $arrets, 'categories' => $categories, 'auteurs' => $auteurs ));
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
            $file = $this->upload->upload(Input::file('file'), 'files/analyses');
        }

        $cats = Input::get('categories');
        if (!empty($cats)) {
            $categories = $this->custom->prepareCategories($cats);
        } else {
            $categories = array();
        }

        $arrs = Input::get('arrets');

        if (!empty($arrs)) {
            $arrets = $this->custom->prepareCategories($arrs);
        } else {
            $arrets = array();
        }

        // Data array author_id
        $data = array(
            'pid'        => 195,
            'user_id'    => Input::get('user_id'),
            'authors'    => Input::get('authors'),
            'author_id'  => Input::get('author_id'),
            'pub_date'   => Input::get('pub_date'),
            'abstract'   => Input::get('abstract'),
            'title'      => Input::get('title'),
            'arrets'     => count($arrets),
            'categories' => count($categories),
            'pub_text'   => Input::get('pub_text')
        );

        // Attach file if any
        $data['file'] = (!empty($file) ? $file['name'] : '');

        // Create analyse
        $analyse = $this->analyse->create($data);

        // Insert related categories
        $analyse->analyses_categories()->sync($categories);
        $analyse->analyses_arrets()->sync($arrets);

        return Redirect::to('admin/analyse/'.$analyse->id)->with(array('status' => 'success' , 'message' => 'Analyse crée'));

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
            $file = $this->upload->upload(Input::file('file'), 'files/analyses');
        }

        $cats = Input::get('categories');
        if (!empty($cats)) {
            $categories = $this->custom->prepareCategories($cats);
        } else {
            $categories = array();
        }

        $arrs = Input::get('arrets');

        if (!empty($arrs)) {
            $arrets = $this->custom->prepareCategories($arrs);
        } else {
            $arrets = array();
        }

        // Data array
        $data = array(
            'id'         => Input::get('id'),
            'authors'    => Input::get('authors'),
            'author_id'  => Input::get('author_id'),
            'pub_date'   => Input::get('pub_date'),
            'abstract'   => Input::get('abstract'),
            'title'      => Input::get('title'),
            'categories' => count($categories),
            'arrets'     => count($arrets),
            'pub_text'   => Input::get('pub_text')
        );

        // Attach file if any
        $data['file'] = (!empty($file) ? $file['name'] : null);

        // Create analyse
        $analyse = $this->analyse->update($data);

        // Insert related categories
        $analyse->analyses_categories()->sync($categories);
        $analyse->analyses_arrets()->sync($arrets);

        return Redirect::to('admin/analyse/'.$analyse->id)->with(array('status' => 'success' , 'message' => 'Analyse mise à jour'));

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
        $this->analyse->delete($id);

        return Redirect::back()->with(array('status' => 'success', 'message' => 'Analyse supprimée' ));
    }

    /**
     * Return one analyse by id
     *
     * @return json
     */
    public function simple($id)
    {
        return $this->analyse->find($id);
    }
}
