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
     * Return all arrets for dropdown
     *
     * @return json
     */
    public function all()
    {
        return $this->arret->getAll();
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