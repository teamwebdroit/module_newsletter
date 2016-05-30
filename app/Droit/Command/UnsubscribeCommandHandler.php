<?php namespace Droit\Command;

use Laracasts\Commander\CommandHandler;
use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Newsletter\Worker\MailjetInterface;

use Droit\Form\UnsubscribeValidation;

class UnsubscribeCommandHandler implements CommandHandler
{

    protected $abo;
    protected $worker;
    protected $validator;

    public function __construct(MailjetInterface $worker, NewsletterUserInterface $abo, UnsubscribeValidation $validator)
    {
        $this->worker    = $worker;
        $this->abo       = $abo;
        $this->validator = $validator;
    }

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
        // Validate the email
        $this->validator->validate(array('email' => $command->email));

        // find the abo
        $abonne = $this->abo->findByEmail($command->email);

        // Sync the abos to newsletter we have
        $abonne->newsletter()->sync($command->newsletter_id);

        try {
            // remove contact from list mailjet
            $this->worker->removeContact($abonne->email);
            // Delete the abonné from DB
            return $this->abo->delete($abonne->email);
        } catch (\Droit\Exceptions\SubscribeUserException $e) {
            throw new \Droit\Exceptions\SubscribeUserException('Erreur synchronisation email vers mailjet', $e->getError());
        }

    }
}
