<?php namespace Droit\Command;

use Laracasts\Commander\CommandHandler;
use Droit\Newsletter\Worker\MailjetInterface;
use Droit\Newsletter\Repo\NewsletterUserInterface;

use Droit\Form\AddUserValidation;
use Droit\Exceptions\SubscribeUserException;

class AdminSubscribeCommandHandler implements CommandHandler {

    protected $abonne;
    protected $worker;
    protected $validator;

    public function __construct( NewsletterUserInterface $abonne, MailjetInterface $worker, AddUserValidation $validator)
    {
        $this->abonne    = $abonne;
        $this->worker    = $worker;
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
        $activated_at  = ( $command->activation ? true : false );

        // Validate email
        $this->validator->validate( array('email' => $command->email ) );

        if(!empty($newsletter_id) && $activated_at)
        {
            // Sync to mailjet
            try
            {
                $this->worker->subscribeEmailToList( $command->email );
            }
            catch(Exception $e)
            {
                throw new \Droit\Exceptions\SubscribeUserException('Erreur synchronisation email vers mailjet', $e->getError() );
            }
        }
        // Add email to listsSubscribe and activate to selected newsletter
        $abonne = $this->abonne->add( array('email' => $command->email, 'activated_at' => $activated_at ) );
        $abonne->newsletter()->sync($newsletter_id);

        return true;

    }

}