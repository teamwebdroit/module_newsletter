<?php namespace Droit\Command;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Laracasts\Validation\FormValidationException;
use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Newsletter\Repo\NewsletterSubscriptionInterface;
use Droit\Form\InscriptionValidation;

class NewsletterSubscribeCommandHandler implements CommandHandler {

    use DispatchableTrait;

    protected $newsletter;

    protected $subscribe;

    protected $validator;

    public function __construct(NewsletterUserInterface $newsletter, NewsletterSubscriptionInterface $subscribe, InscriptionValidation $validator)
    {
        $this->newsletter = $newsletter;
        $this->subscribe  = $subscribe;
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

        $activation_token = md5( $command->email.\Carbon\Carbon::now() );

        $suscribe = $this->newsletter->create( array('email' => $command->email, 'activation_token' => $activation_token) );

        $suscribe->newsletter()->sync($command->newsletter_id);

        $this->dispatchEventsFor($suscribe);

        return $suscribe;
    }

}