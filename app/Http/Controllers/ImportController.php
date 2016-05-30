<?php

use Droit\Newsletter\Repo\NewsletterInterface;
use Droit\Service\Worker\UploadInterface;
use Droit\Newsletter\Worker\MailjetInterface;
use Droit\Newsletter\Repo\NewsletterUserInterface;

class ImportController extends \BaseController {

	protected $newsletter;
	protected $upload;
	protected $mailjet;
	protected $subscriber;

	public function __construct( UploadInterface $upload, MailjetInterface $mailjet, NewsletterUserInterface $subscriber, NewsletterInterface $newsletter)
	{
		$this->newsletter = $newsletter;
		$this->upload     = $upload;
		$this->mailjet    = $mailjet;
		$this->subscriber = $subscriber;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index()
	{
		$newsletters = $this->newsletter->getAll();

		return View::make('newsletter.import')->with(['newsletters' => $newsletters]);
	}

	public function store()
	{
		$files = $this->upload->upload( Input::file('file') , 'files' );
		$list  = Input::get('newsletter_id');

		if($files)
		{
			// path to csv
			$path = public_path('files/'.$files['name']);

			$result = \Excel::load($path, function($reader) {
				$reader->ignoreEmpty();
				$reader->setSeparator('\r\n');
			})->get();

			foreach($result as $email)
			{
				$subscriber = $this->subscriber->findByEmail($email->email);

				if(!$subscriber)
				{
					$subscriber = $this->subscriber->add([
						'email'         => $email->email,
						'newsletter_id' => $list
					]);
				}

				$relation = $subscriber->subscription()->lists('newsletter_id');
				$contains = in_array($list,$relation);

				if(!$contains)
				{
					$subscriber->newsletter()->attach($list);
				}
			}

			// Convert to csv
			\Excel::load($path, function($file) {

			})->store('csv', public_path('files/import'));

			// Import csv to mailjet ONLY TESTING
			//$this->mailjet->setList(1545504); // testing list

			$filename = preg_replace('/\\.[^.\\s]{3,4}$/', '', $files['name']);

			$dataID   = $this->mailjet->uploadCSVContactslistData(file_get_contents(public_path('files/import/'.$filename.'.csv')));
			$response = $this->mailjet->importCSVContactslistData($dataID->ID);

			return Redirect::back()->with(array('status' => 'success', 'message' => 'Import terminé' ));
		}
	}

}