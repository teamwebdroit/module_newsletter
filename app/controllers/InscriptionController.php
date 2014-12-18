<?php

use Laracasts\Commander\CommanderTrait;
use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Command\NewsletterSubscribeCommand;
use Droit\Command\UnsubscribeCommand;

class InscriptionController extends \BaseController {

    use CommanderTrait;

    protected $abo;
    protected $worker;

    public function __construct(CampagneInterface $worker, NewsletterUserInterface $abo)
    {
        $this->worker = $worker;
        $this->abo    = $abo;
    }

    /**
	 * Activate newsletter abo
	 * GET //activation
	 *
	 * @return Response
	 */
	public function activation($token)
	{

        // Activate the email on the website
        $email = $this->abo->activate($token);

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

            return Redirect::to('/')->with( array('status' => 'success' , 'message' => 'Vous êtes maintenant abonné à la newsletter en droit du travail') );
        }
        else
        {
            throw new \Droit\Exceptions\TokenInscriptionException('Token mismatch', array());
        }

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
                                                              <br/>Veuillez confirmer votre adresse email en cliquant le lien qui vous à été envoyé par email'));
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