<?php

use Laracasts\Commander\CommanderTrait;
use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Newsletter\Worker\StatsWorker;
use Droit\Exceptions\CampagneSendException;
use Droit\Command\SendCampagneCommand;

class SendController extends \BaseController {

    use CommanderTrait;

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
     * GET /campagne/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $campagne     = $this->worker->getCampagne($id);
        $statistiques = $this->worker->statsCampagne($campagne->api_campagne_id);
        $listStats    = $this->worker->campagneAggregate($campagne->api_campagne_id);
        $senderList   = $this->worker->getAllSubscribers();
        $statistiques = $this->statsworker->filterResponseStatistics($statistiques);

        return View::make('newsletter.send')->with(
            array(
                'isChart'        => true ,
                'campagne'       => $campagne ,
                'statistiques'   => $statistiques,
                'listStats'      => $listStats,
                'senderList'     => $senderList
            )
        );
    }

    /**
     * Display the specified resource.
     * GET /campagne/{id}
     *
     * @param  int  $id
     * @return Response
     */
    public function statistiques($id)
    {
        $campagne = $this->campagne->find($id);

        return View::make('newsletter.stats')->with(array( 'campagne' => $campagne , 'infos' => $infos ));
    }

    /**
     * Send campagne newsletter
     * GET /send/campagne/{$id}
     */
	public function campagne()
	{
        $id       = Input::get('id');
        $message  = $this->execute('Droit\Command\SendCampagneCommand', array('id' => $id) );

        return Redirect::to('admin/campagne')->with( array('status' => 'success' , 'message' => $message ) );
	}

    public function test(){

        $id    = Input::get('id');
        $email = Input::get('email');

        $campagne = $this->worker->getCampagne($id);
        $sujet    = 'TEST | '.$campagne->sujet;

        // GET html
        $html = $this->worker->html($campagne->id);

        $this->worker->sendTest($email,$html,$sujet);

        return Redirect::to('admin/campagne/'.$id)->with( array('status' => 'success' , 'message' => 'Email de test envoyé!' ) );
    }

}