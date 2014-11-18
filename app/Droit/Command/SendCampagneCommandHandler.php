<?php namespace Droit\Command;

use Laracasts\Commander\CommandHandler;
use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Exceptions\CampagneSendException;

class SendCampagneCommandHandler implements CommandHandler {

    protected $worker;

    public function __construct( CampagneInterface $worker)
    {
        $this->worker = $worker;
    }

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
        // Get campagne
        $campagne = $this->worker->getCampagne($command->id);

        //set or update html
        $html = $send->html($campagne->id);
        $sent = $send->setHtml($html,$campagne->api_campagne_id);

        try
        {
            if($command->email)
            {
                $this->worker->sendTest($command->email,$campagne->api_campagne_id);
                $message = 'Email de test envoyé!';
            }
            else{
                $this->worker->sendCampagne($campagne->api_campagne_id);
                $message = 'Campagne envoyé!';
            }


            return Redirect::to('admin/campagne/'.$campagne->id)->with( array('status' => 'success' , 'message' => $message) );
        }
        catch (Exception $e)
        {
            throw new \Droit\Exceptions\CampagneSendException('Problème avec l\'envoi de la campagne', $e->getError() );
        }
    }

}