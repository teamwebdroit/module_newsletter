<?php

use Droit\Service\Worker\UploadInterface;

class UploadController extends Controller
{

    protected $upload;

    public function __construct(UploadInterface $upload)
    {

        $this->upload = $upload;

    }

    public function uploadJS()
    {

        $files = $this->upload->upload(Input::file('file'), 'files');

        if ($files) {
            return Response::json(
                array(
                'success' => true,
                'files'   => Input::file(),
                'get'     => Input::all(),
                'post'    => Input::all()
                ),
                200
            );

        }

        return false;

    }

    public function uploadRedactor()
    {
        $files = $this->upload->upload(Input::file('file'), 'files');

        if ($files) {
            $array = array(
                'filelink' => URL::to('/').'/files/'.$files['name'],
                'filename' => $files['name']
            );

            return Response::json($array, 200);
        }

        return false;

    }

    public function uploadJquery()
    {
        $allfiles = Input::file('files');
        $folder   = Input::get('folder');
        $path     = (isset($folder) && !empty($folder) ? $folder : 'files');

        $uploaded = array();
        $result   = array();

        if (!empty($allfiles)) {
            foreach ($allfiles as $file) {
                $newfile = $this->upload->upload($file, $path);

                if ($newfile) {
                    $uploaded[] =  array(
                        "name" => $newfile['name'],
                        "size" => $newfile['size'],
                        "url"  => URL::to('/').'/files/'.$newfile['name']
                    );
                } else {
                    $uploaded[] = array(
                    "name"  => $newfile['name'],
                    "size"  => $newfile['size'],
                    "error" => "Problème avec l\'upload"
                    );
                }
            }

            $result = array('files' => $uploaded);
        }

        return Response::json($result, 200);

    }

    public function imageJson()
    {
        $files = File::files('files');

        $data   = [];
        $except = ['.DS_Store'];

        if (!empty($files)) {
            foreach ($files as $file) {
                if (!in_array($file, $except)) {
                    $data[] = ['image' => url('/').'/'.$file, 'thumb' => url('/').'/'.$file, 'title' => $file];
                }
            }
        }

        return Response::json($data);
    }

    public function fileJson()
    {
        $files = File::files('files');

        $data   = [];
        $except = ['.DS_Store'];

        if (!empty($files)) {
            foreach ($files as $file) {
                if (!in_array($file, $except)) {
                    $data[] = ['name' => $file, 'link' => url('/').'/'.$file, 'title' => $file];
                }
            }
        }

        return Response::json($data);
    }
}
