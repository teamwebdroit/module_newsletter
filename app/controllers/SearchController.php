<?php

use Droit\Service\Worker\SearchInterface;

class SearchController extends BaseController {
	
	protected $search;

	public function __construct( SearchInterface $search){
		
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

		if($search){
            $arrets  = $this->search->find($search);
		}

		return View::make('admin.search.index')->with( array('arrets' => $arrets , 'search' => $search ) );
		        
	}

}
