<?php

use Laracasts\Commander\CommanderTrait;
use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Newsletter\Repo\NewsletterInterface;
use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Command\AdminSubscribeCommandHandler;
use Laracasts\Validation\FormValidationException;
use Droit\Form\AddUserValidation;
use Droit\Command\UnsubscribeCommand;

class AbonneController extends \BaseController {

    use CommanderTrait;

    protected $abonne;
    protected $newsletter;
    protected $validator;
    protected $worker;

    public function __construct(NewsletterUserInterface $abonne, NewsletterInterface $newsletter, AddUserValidation $validator, CampagneInterface $worker)
    {
        $this->abonne     = $abonne;
        $this->newsletter = $newsletter;
        $this->validator  = $validator;
        $this->worker     = $worker;
    }

	/**
	 * Display a listing of the resource.
	 * GET /abonne
	 *
	 * @return Response
	 */
	public function index()
	{
        $abonnes = $this->abonne->getAll();

        return View::make('admin.abonnes.index')->with( array('abonnes' => $abonnes) );
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /abonne/create
	 *
	 * @return Response
	 */
	public function create()
	{
        $newsletter = $this->newsletter->getAll();

        return View::make('admin.abonnes.create')->with(array( 'newsletter' => $newsletter ));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /abonne
	 *
	 * @return Response
	 */
	public function store()
	{

        $this->execute('Droit\Command\AdminSubscribeCommand');

        return Redirect::to('admin/abonne')->with( array('status' => 'success' , 'message' => 'Abonné ajouté') );
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /abonne/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $abonne     = $this->abonne->find($id);
        $newsletter = $this->newsletter->getAll();

        return View::make('abonnes.edit')->with(array( 'abonne' => $abonne , 'newsletter' => $newsletter ));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /abonne/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{

        $newsletter_id = (Input::get('newsletter_id') ? Input::get('newsletter_id') : array() );

        $command = array(
            'id'            => Input::get('id') ,
            'email'         => Input::get('email'),
            'newsletter_id' => $newsletter_id,
            'activation'    => Input::get('activation')
        );

        $this->execute('Droit\Command\UpdateSubscriberCommand', $command );

        return Redirect::to('admin/abonne/'.$id.'/edit')->with( array('status' => 'success' , 'message' => 'Abonné édité') );

	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /abonne/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($email)
	{
        $command = array('email' => $email, 'newsletter_id' => array(1));

        $this->execute('Droit\Command\UnsubscribeCommand',$command);

        return Redirect::back()->with(array('status' => 'success', 'message' => 'Abonné supprimé' ));
	}

}