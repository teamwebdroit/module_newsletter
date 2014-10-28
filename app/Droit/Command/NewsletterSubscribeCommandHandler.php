<?php namespace Droit\Command;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Droit\Newsletter\Repo\NewsletterUserInterface;

class NewsletterSubscribeCommandHandler implements CommandHandler {

    use DispatchableTrait;

    protected $newsletter;

    public function __construct(NewsletterUserInterface $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Handle the command.
     *
     * @param object $command
     * @return void
     */
    public function handle($command)
    {
        $activation_token = \Hash::make( $command->email.\Carbon\Carbon::now() );

        $suscribe = $this->newsletter->create( array('email' => $command->email, 'activation_token' => $activation_token) );

        $this->dispatchEventsFor($suscribe);

        return $suscribe;
    }

}