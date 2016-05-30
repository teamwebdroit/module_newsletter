<?php

use Laracasts\Commander\CommanderTrait;
use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Command\NewsletterSubscribeCommand;
use Droit\Command\UnsubscribeCommand;
use Droit\Command\ConfirmSubscriptionCommand;

class InscriptionController extends \BaseController
{

    use CommanderTrait;

    protected $abo;

    public function __construct(NewsletterUserInterface $abo)
    {
        $this->beforeFilter('csrf', array('only' => array('store','unsubscribe')));

        $this->abo = $abo;
    }

    /**
     * Activate newsletter abo
     * GET //activation
     *
     * @return Response
     */
    public function activation($token)
    {

        $this->execute('Droit\Command\ConfirmSubscriptionCommand', array('token' => $token));

        return Redirect::to('/')
            ->with(array('status' => 'success', 'message' => 'Vous êtes maintenant abonné à la newsletter en droit du travail'));

    }

    /**
     * Store a newly created resource in storage.
     * POST /inscription
     *
     * @return Response
     */
    public function store()
    {
        $this->execute('Droit\Command\NewsletterSubscribeCommand');

        return Redirect::to('/')
            ->with(array('status' => 'success', 'message' => '<strong>Merci pour votre inscription!</strong>
                                                              <br/>Veuillez confirmer votre adresse email en cliquant le lien qui vous a été envoyé par email'));
    }

    /**
     * Resend activation link email
     * POST /inscription/resend/email
     *
     * @return Response
     */
    public function resend()
    {
        $email = Input::get('email');
        $this->abo->delete($email);

        $this->execute('Droit\Command\NewsletterSubscribeCommand');

        return Redirect::to('/')->with(array('status' => 'success', 'message' => '<strong>Lien d\'activation envoyé</strong>'));
    }

    /**
     * Remove the email from list - unsubscribe.
     * POST /inscription/unsubscribe
     *
     * @return Response
     */
    public function unsubscribe()
    {
        $this->execute('Droit\Command\UnsubscribeCommand');

        return Redirect::to('/')->with(array('status' => 'success', 'message' => '<strong>Vous avez été désinscrit</strong>'));
    }
}
