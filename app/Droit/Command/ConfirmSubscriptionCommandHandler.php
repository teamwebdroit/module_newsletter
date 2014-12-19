<?php namespace Droit\Command;

use Laracasts\Commander\CommandHandler;
use Droit\Newsletter\Worker\MailjetInterface;
use Droit\Newsletter\Repo\NewsletterUserInterface;

class ConfirmSubscriptionCommandHandler implements CommandHandler {

    protected $abo;
    protected $worker;

    public function __construct(MailjetInterface $worker, NewsletterUserInterface $abo)
    {
        $this->worker = $worker;
        $this->abo    = $abo;
    }

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {

        // Activate the email on the website
        $email = $this->abo->activate($command->token);

        if($email)
        {
            // Sync to mailjet or at least try
            try
            {
                $this->worker->subscribeEmailToList( $email->email );
            }
            catch(\Droit\Exceptions\SubscribeUserException $e)
            {
                throw new \Droit\Exceptions\SubscribeUserException('Erreur synchronisation email vers mailjet', $e->getError() );
            }

        }
        else
        {
            throw new \Droit\Exceptions\TokenInscriptionException('Token mismatch', array());
        }

        return true;
    }

}