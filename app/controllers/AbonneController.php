<?php

use Laracasts\Commander\CommanderTrait;
use Droit\Newsletter\Repo\NewsletterUserInterface;
use Droit\Newsletter\Repo\NewsletterInterface;
use Droit\Newsletter\Worker\CampagneInterface;
use Droit\Command\AdminSubscribeCommandHandler;
use Laracasts\Validation\FormValidationException;
use Droit\Form\AddUserValidation;


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

        return View::make('abonnes.index')->with( array('abonnes' => $abonnes) );
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

        return View::make('abonnes.create')->with(array( 'newsletter' => $newsletter ));
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /abonne
	 *
	 * @return Response
	 */
	public function store()
	{
/*        echo '<pre>';
        print_r(Input::all());
        echo '</pre>';exit;*/

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
        $activation    = Input::get('activation');
        $newsletter_id = Input::get('newsletter_id');

        $activated_at  = ($activation ? true : false );
        $newsletter_id = ( $newsletter_id ? $newsletter_id : array() );

        $abonne = $this->abonne->update( array( 'id' => $id, 'email' => Input::get('email'), 'activated_at' => $activated_at ) );

        $abonne->newsletter()->sync($newsletter_id);

        return Redirect::to('admin/abonne/'.$abonne->id.'/edit')->with( array('status' => 'success' , 'message' => 'Abonné édité') );
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /abonne/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
        $this->abonne->delete($id);

        return Redirect::back()->with(array('status' => 'success', 'message' => 'Abonné supprimé' ));
	}

}