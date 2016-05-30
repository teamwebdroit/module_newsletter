<?php namespace Droit\Command;

use Laracasts\Commander\CommandHandler;
use Droit\Newsletter\Worker\MailjetInterface;
use Droit\Newsletter\Worker\CampagneInterface;

class SendCampagneCommandHandler implements CommandHandler
{

    protected $worker;
    protected $campagne;

    public function __construct(MailjetInterface $worker, CampagneInterface $campagne)
    {
        $this->worker   = $worker;
        $this->campagne = $campagne;
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
        $campagne = $this->campagne->getCampagne($command->id);

        //set or update html
        $html = $this->campagne->html($campagne->id);

        try {
            // Sync html content to api service and send!
            $this->worker->setHtml($html, $campagne->api_campagne_id);
            $this->worker->sendCampagne($campagne->api_campagne_id, $campagne->id);

            // Update campagne status
            $campagne->status     = 'envoyé';
            $campagne->updated_at = date('Y-m-d G:i:s');

            $campagne->save();

            return 'Campagne envoyé!';

        } catch (Exception $e) {
            throw new \Droit\Exceptions\CampagneSendException('Problème avec l\'envoi', $e->getError());
        }
    }
}
