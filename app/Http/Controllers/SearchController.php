<?php

use Droit\Service\Worker\SearchInterface;

class SearchController extends Controller
{
    
    protected $search;

    public function __construct(SearchInterface $search)
    {
        
        $this->search = $search;

        View::share('pageTitle', 'Recherche');
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $search = Request::get('search');
        $arrets = array();

        if ($search) {
            $arrets  = $this->search->find($search);
        }

        return view('admin.search.index')->with(array('arrets' => $arrets , 'search' => $search ));
                
    }
}
