<?php

use Laracasts\Commander\CommanderTrait;
use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Command\NewsletterSubscribeCommand;

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
	 * Show the form for creating a new resource.
	 * GET /inscription/create
	 *
	 * @return Response
	 */
	public function create()
	{
		//
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
	 * Display the specified resource.
	 * GET /inscription/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /inscription/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /inscription/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the email from list - unsubscribe.
	 * POST /inscription/unsubscribe
	 *
	 * @return Response
	 */
	public function unsubscribe()
	{

        $email = Input::get('email');

        if(!$email){
            return Redirect::back()->with(array('status' => 'danger', 'message' => '<strong>Veuillez indiquer un email</strong>'));
        }

        $abonne = $this->abo->findByEmail( $email );

        if(!$abonne){
            return Redirect::back()->with(array('status' => 'danger', 'message' => '<strong>Votre email n\'existe pas dans la base de données</strong>'));
        }
        // Sync the abos to newsletter we have
        $abonne->newsletter()->sync(array(Input::get('newsletter_id')));

        $this->worker->removeContact($abonne->email);

        return Redirect::to('/')->with(array('status' => 'success', 'message' => '<strong>Vous avez été désinscrit</strong>'));
	}

}