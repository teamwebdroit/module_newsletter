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