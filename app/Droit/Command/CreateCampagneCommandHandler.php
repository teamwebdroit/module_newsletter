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
        $data['sujet']         = $command->sujet;
        $data['auteurs']       = $command->auteurs;
        $data['newsletter_id'] = 1;

        $campagne = $this->campagne->create( $data );

        if($this->worker->createCampagne($campagne))
        {
            return $campagne;
        }
        else
        {
            throw new \Droit\Exceptions\CampagneCreationException('Problème avec la création de campagne sur mailjet ', array('status' => 'error') );
        }

    }

}