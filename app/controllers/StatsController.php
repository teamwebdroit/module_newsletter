<?php

use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Newsletter\Worker\StatsWorker;

class StatsController extends \BaseController {

    protected $worker;
    protected $statsworker;
    protected $charts;

    public function __construct( CampagneInterface $worker, StatsWorker $statsworker)
    {
        $this->worker = $worker;
        $this->statsworker  = $statsworker;
        $this->charts = new \Charts;
    }

    /**
	 * Display a listing of the resource.
	 * GET /stats
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /stats/create
	 *
	 * @return Response
	 */
	public function chartDoughnut($id)
	{
        $campagne     = $this->worker->getCampagne($id);
        $statistiques = $this->worker->statsCampagne($campagne->api_campagne_id);
        $doughnut     = $this->charts->chartDoughnut($statistiques);

        return $doughnut;
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /stats
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /stats/{id}
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
	 * GET /stats/{id}/edit
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
	 * PUT /stats/{id}
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
	 * DELETE /stats/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}