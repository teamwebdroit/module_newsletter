<?php

use Droit\Service\Worker\UploadInterface;

class UploadController extends BaseController {

    public function __construct( UploadInterface $upload )
    {

        $this->upload = $upload;

    }

    public function uploadJS()
    {

        $files = $this->upload->upload( Input::file('file') , 'files' );

        if($files)
        {
            return Response::json(array(
                    'success' => true,
                    'files'   => Input::file(),
                    'get'     => Input::all(),
                    'post'    => Input::all()
                ),
            200 );

        }

        return false;

    }


    public function uploadRedactor()
    {
        $files = $this->upload->upload( Input::file('file') , 'files' );

        if($files)
        {
            $array = array(
                'filelink' => URL::to('/').'/files/'.$files['name'],
                'filename' => $files['name']
            );

            return Response::json($array,200 );
        }

        return false;

    }

}
