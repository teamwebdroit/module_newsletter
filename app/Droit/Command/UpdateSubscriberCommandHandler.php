<?php namespace Droit\Command;

use Laracasts\Commander\CommandHandler;
use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Newsletter\Worker\MailjetInterface;

class UpdateSubscriberCommandHandler implements CommandHandler
{

    protected $worker;
    protected $abonne;
    protected $custom;

    public function __construct(NewsletterUserInterface $abonne, MailjetInterface $worker)
    {
        $this->abonne = $abonne;
        $this->worker = $worker;
        $this->custom = new \Custom;
    }

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {

        $abonne = $this->abonne->update(array( 'id' => $command->id, 'email' => $command->email, 'activated_at' => $command->activation ));

        // Sync the abos to newsletter we have
        $abonne->newsletter()->sync($command->newsletter_id);

        $abos  = ( !$abonne->subscription->isEmpty() ? $abonne->subscription->lists('newsletter_id') : array() );

        $exist =  $this->custom->allInArray($command->newsletter_id, $abos);

        if (!empty($command->newsletter_id) && !$exist) {
            return $this->worker->subscribeEmailToList($abonne->email);
        } else {
            return $this->worker->removeContact($abonne->email);
        }

    }
}
