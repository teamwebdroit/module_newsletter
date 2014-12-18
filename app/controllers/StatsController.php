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
        $statistiques  = $this->worker->statsAllCampagne();

        return View::make('admin.stats.index')->with(
            array(
                'isChart'        => true ,
                'statistiques'   => $statistiques
            )
        );
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
	 * Display the specified resource.
	 * GET /stats/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
        $campagne     = $this->worker->getCampagne($id);
        $statistiques = $this->worker->statsCampagne($campagne->api_campagne_id);

        return View::make('admin.stats.show')->with(
            array(
                'isChart'        => true,
                'campagne'       => $campagne ,
                'statistiques'   => $statistiques
            )
        );
	}


}