<?php namespace Droit\Command;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Validation\FormValidationException;
use Droit\Exceptions\SubscribeUserException;

use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Form\InscriptionValidation;

class NewsletterSubscribeCommandHandler implements CommandHandler {

    use DispatchableTrait;

    protected $newsletter;
    protected $validator;

    public function __construct(NewsletterUserInterface $newsletter, InscriptionValidation $validator)
    {
        $this->newsletter = $newsletter;
        $this->validator  = $validator;
    }

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
        $this->validator->validate( array('email' => $command->email) );

        // Make activation token
        $activation_token = md5( $command->email.\Carbon\Carbon::now() );

        // Subscribe user to website list and synch newsletter abos
        $suscribe = $this->newsletter->create( array('email' => $command->email, 'activation_token' => $activation_token) );
        $suscribe->newsletter()->sync($command->newsletter_id);

        // Events notifier, send email for abo confirmation
        $this->dispatchEventsFor($suscribe);

        return $suscribe;
    }

}