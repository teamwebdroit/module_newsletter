<?php

/**
 * Stats controller
 *
 * Campagne statistiques
 */

use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Newsletter\Worker\StatsWorker;

class StatsController extends \BaseController {

    protected $worker;
    protected $statsworker;
    protected $charts;

    public function __construct( CampagneInterface $worker, StatsWorker $statsworker)
    {
        $this->worker       = $worker;
        $this->statsworker  = $statsworker;
        $this->charts       = new \Charts;
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
        // Stats open, bounce etc.
        $campagne     = $this->worker->getCampagne($id);
        $statistiques = $this->worker->statsCampagne($campagne->api_campagne_id);
        $statistiques = $this->statsworker->filterResponseStatistics($statistiques);
        $statistiques = $this->charts->compileStats($statistiques);

        // Clicks
        $clickStats = $this->worker->clickStatistics($id);
        $clickStats = $this->statsworker->filterResponseStatisticsMany($clickStats);
        $clickStats = $this->statsworker->aggregateStatsClicksLinks($clickStats);

        return View::make('admin.stats.show')->with(
            array(
                'isChart'      => true,
                'campagne'     => $campagne ,
                'statistiques' => $statistiques,
                'clickStats'   => $clickStats
            )
        );
	}


}