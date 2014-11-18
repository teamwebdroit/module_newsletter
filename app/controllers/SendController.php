<?php

use Laracasts\Commander\CommanderTrait;
use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Exceptions\CampagneSendException;
use Droit\Command\SendCampagneCommand;

class SendController extends \BaseController {

    use CommanderTrait;

    protected $worker;

    public function __construct( CampagneInterface $worker)
    {
        $this->worker = $worker;
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

        return View::make('newsletter.send')->with(array( 'campagne' => $campagne , 'statistiques' => $statistiques ));
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

        $id    = Input::get('id');
        $email = Input::get('email');
        $email = ($email ? $email : false);

        $message  = $this->execute('Droit\Command\SendCampagneCommand', array('id' => $id, 'email' => $email) );

        return Redirect::to('admin/campagne/'.$id)->with( array('status' => 'success' , 'message' => $message ) );

	}

}