<?php

use Droit\Author\Repo\AuthorInterface;
use Droit\Service\Worker\UploadInterface;

class AuthorController extends \BaseController
{

    protected $author;
    protected $upload;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(AuthorInterface $author, UploadInterface $upload)
    {
        $this->author = $author;
        $this->upload = $upload;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $authors = $this->author->getAll();

        return View::make('admin.authors.index')->with(array('authors' => $authors ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('admin.authors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $all   = Input::all();
        $_file = Input::file('photo', null);

        if ($_file) {
            $photo = $this->upload->upload($_file, 'authors');
            $all['photo'] = $photo['name'];
        }

        $author = $this->author->create($all);

        return Redirect::to('admin/author/'.$author->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $author = $this->author->find($id);

        return View::make('admin.authors.show')->with(array( 'author' => $author ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $all   = Input::all();
        $_file = Input::file('photo', null);

        if ($_file) {
            $photo = $this->upload->upload($_file, 'authors');
            $all['photo'] = $photo['name'];
        }

        $author = $this->author->update($all);

        return Redirect::to('admin/author/'.$author->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $this->author->delete($id);

        return Redirect::to('admin/author')->with(array('status' => 'success', 'message' => 'Auteur supprimé' ));
    }
}
