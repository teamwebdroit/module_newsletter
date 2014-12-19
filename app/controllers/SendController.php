<?php
/**
 * Send controller
 *
 * Send campagne, Send test campagne
 */

use Laracasts\Commander\CommanderTrait;
use Droit\Newsletter\Worker\MailjetInterface;

use Droit\Command\SendCampagneCommand;

class SendController extends \BaseController {

    use CommanderTrait;

    protected $worker;

    public function __construct( MailjetInterface $worker)
    {
        $this->worker = $worker;
    }

    /**
     * Send campagne newsletter
     * GET /send/campagne/{$id}
     */
	public function campagne()
	{
        $message  = $this->execute('Droit\Command\SendCampagneCommand', array('id' => Input::get('id')) );

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