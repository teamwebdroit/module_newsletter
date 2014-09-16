<?php

use Droit\Service\Worker\UploadInterface;

class UploadController extends BaseController {

    public function __construct( UploadInterface $upload )
    {

        $this->upload = $upload;

    }

	public function store()
	{

        $destination = Input::get('destination');

        return $this->upload->upload( Input::file('file') , $destination );

	}

}
