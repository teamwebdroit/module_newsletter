<?php

/**
 * Stats controller
 *
 * Campagne statistiques
 */

use Droit\Newsletter\Worker\MailjetInterface;
use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Newsletter\Worker\StatsWorker;

class StatsController extends \BaseController {

    protected $worker;
    protected $campagne;
    protected $statsworker;
    protected $charts;

    public function __construct( MailjetInterface $worker,CampagneInterface $campagne, StatsWorker $statsworker)
    {
        $this->worker       = $worker;
        $this->campagne     = $campagne;
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
        $campagne     = $this->campagne->getCampagne($id);

        $campagneStats = $this->worker->statsCampagne($campagne->api_campagne_id);
        $campagneStats = $this->statsworker->filterResponseStatistics($campagneStats);
        $statistiques  = $this->charts->compileStats($campagneStats);

        // Clicks
        $clickStats = $this->worker->clickStatistics($campagneStats->CampaignID);
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