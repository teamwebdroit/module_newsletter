<?php
/**
 * Send controller
 *
 * Send campagne, Send test campagne
 */

use Laracasts\Commander\CommanderTrait;
use Droit\Newsletter\Worker\MailjetInterface;
use Droit\Newsletter\Worker\CampagneInterface;

use Droit\Command\SendCampagneCommand;

class SendController extends \BaseController
{

    use CommanderTrait;

    protected $worker;
    protected $campagne;

    public function __construct(MailjetInterface $worker, CampagneInterface $campagne)
    {
        $this->worker   = $worker;
        $this->campagne = $campagne;
    }

    /**
     * Send campagne newsletter
     * GET /send/campagne/{$id}
     */
    public function campagne()
    {
        $message  = $this->execute('Droit\Command\SendCampagneCommand', array('id' => Input::get('id')));

        return Redirect::to('admin/campagne')->with(array('status' => 'success' , 'message' => $message ));
    }

    public function test()
    {

        $id    = Input::get('id');
        $email = Input::get('email');

        $campagne = $this->campagne->getCampagne($id);
        $sujet    = ($campagne->status == 'brouillon' ? 'TEST | '.$campagne->sujet : $campagne->sujet );

        // GET html
        $html = $this->campagne->html($campagne->id);

        $this->worker->sendTest($email, $html, $sujet);

        $ajax = Input::get('send_type', 'normal');

        if ($ajax == 'ajax') {
            echo 'ok';
            exit;
        }

        return Redirect::to('admin/campagne/'.$id)->with(array('status' => 'success' , 'message' => 'Email de test envoyé!' ));
    }
}
