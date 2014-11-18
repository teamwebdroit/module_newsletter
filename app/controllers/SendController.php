<?php

use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Exceptions\CampagneSendException;

class SendController extends \BaseController {

    protected $worker;

    public function __construct( CampagneInterface $worker)
    {
        $this->worker = $worker;
    }

    /**
	 * Send test newsletter
	 * GET /send/test/{$id}
	 */
	public function test()
	{
        $id    = Input::get('campagne_id');
        $email = Input::get('email');

        // Get campagne
        $campagne = $this->worker->getCampagne($id);

        try
        {
            $this->worker->sendTest($email,$campagne->api_campagne_id);

            return Redirect::to('admin/campagne/'.$campagne->id)->with( array('status' => 'success' , 'message' => 'Email de test envoyé!') );
        }
        catch (Exception $e)
        {
            throw new \Droit\Exceptions\CampagneSendException('Problème avec l\'envoi de la campagne', $e->getError() );
        }

        // $html = $this->worker->html($id);

        /*
        try
        {
            $subject   = $campagne->sujet.' | '.$campagne->newsletter->titre;
            $fromEmail = $campagne->newsletter->from_email;
            $fromName  = $campagne->newsletter->from_name;

            \Mail::send('emails.newsletter', array('html' => $html) , function($message) use ( $email, $fromEmail,$fromName, $subject )
            {
                $message->to($email, '');
                $message->from($fromEmail, $fromName);
                $message->subject($subject);
            });

            return Redirect::to('admin/campagne/'.$campagne->id)->with( array('status' => 'success' , 'message' => 'Email de test envoyé!') );
        }
        catch (Exception $e)
        {
            throw new \Droit\Exceptions\CampagneSendException('Problème avec l\'envoi de la campagne', $e->getError() );
        }*/

	}

    /**
     * Send campagne newsletter
     * GET /send/campagne/{$id}
     */
	public function campagne($id)
	{
        // Get campagne
        $campagne = $this->worker->getCampagne($id);

        //set or update html
        $html = $send->html($campagne->id);
        $sent = $send->setHtml($html,$campagne->api_campagne_id);

        try
        {
            $this->worker->sendCampagne($campagne->api_campagne_id);

            return Redirect::to('admin/campagne/'.$campagne->id)->with( array('status' => 'success' , 'message' => 'Campagne envoyé!') );
        }
        catch (Exception $e)
        {
            throw new \Droit\Exceptions\CampagneSendException('Problème avec l\'envoi de la campagne', $e->getError() );
        }
	}

}