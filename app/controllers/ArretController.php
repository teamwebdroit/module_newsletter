<?php

use Droit\Arret\Repo\ArretInterface;

class ArretController extends \BaseController {

    public function __construct( ArretInterface $arret)
    {
        $this->arret  = $arret;
    }

	/**
	 * Display a listing of the resource.
	 * GET /arret
	 *
	 * @return Response
	 */

    public function index()
    {
        return View::make('newsletter.test');
    }


    /**
     * Return one arret by id
     *
     * @return json
     */
    public function show($id)
    {
        $arret = $this->arret->find($id);

        return View::make('newsletter.arret')->with(array( 'arret' => $arret));
    }

}