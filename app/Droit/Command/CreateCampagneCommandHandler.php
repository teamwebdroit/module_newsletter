<?php namespace Droit\Command;

use Laracasts\Commander\CommandHandler;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;
use Droit\Newsletter\Worker\MailjetInterface;

class CreateCampagneCommandHandler implements CommandHandler {

    protected $campagne;
    protected $worker;

    public function __construct(NewsletterCampagneInterface $campagne, MailjetInterface $worker)
    {
        $this->campagne = $campagne;
        $this->worker   = $worker;
    }
    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
        $campagne = $this->campagne->create( array('sujet' => $command->sujet, 'auteurs' => $command->auteurs, 'newsletter_id' => 1 ) );

        try
        {
            $this->worker->createCampagne($campagne);
            return $campagne;
        }
        catch (\Droit\Exceptions\CampagneCreationExceptio $e)
        {
            throw new \Droit\Exceptions\CampagneCreationException('Problème avec la création de campagne sur mailjet ', array('status' => 'error') );
        }

    }

}