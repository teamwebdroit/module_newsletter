<?php namespace Droit\Command;

use Laracasts\Commander\CommandHandler;
use Laracasts\Commander\Events\DispatchableTrait;
use Droit\Form\MessageValidation;

class MessageSendCommandHandler implements CommandHandler
{

    use DispatchableTrait;

    protected $validator;

    public function __construct(MessageValidation $validator)
    {
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
        $data = array('email' => $command->email, 'nom' => $command->nom, 'remarque' => $command->remarque );

        $this->validator->validate($data);

        \Mail::send('emails.contact', $data, function ($message) {
        
            $message->to('info@droitdutravail.ch', 'Droit du travail')->subject('Message depuis le site www.droitdutravail.ch');
        });

    }
}
