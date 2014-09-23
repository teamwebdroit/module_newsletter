<?php

use \InlineStyle\InlineStyle;
use Droit\Service\Worker\UploadInterface;
use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterTypesInterface;

class NewsletterController extends BaseController {

    protected $upload;

    protected $content;

    protected $types;

    /* Inject dependencies */
    public function __construct(UploadInterface $upload, NewsletterContentInterface $content, NewsletterTypesInterface $types)
    {
        $this->upload  = $upload;

        $this->content = $content;

        $this->types   = $types;

        /*
         * Urls
        */
        $shared['unsuscribe'] = url('/');
        $shared['browser']    = url('/');

        /*
         * Colors
        */
        $shared['redBail']    = 'cb2629';
        $shared['grayBail']   = '303030';
        $shared['borderGray'] = 'ededed';

        /*
         * Styles
        */
        $shared['header']       = 'color: #ffffff; font-size: 18px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;';
        $shared['titleRed']     = 'font-family: Arial, Helvetica,sans-serif;font-size:14px;font-weight:bold;color:#'.$shared['redBail'].';margin: 0 0 10px 0;padding: 0 0 0 0;';
        $shared['soustitleRed'] = 'font-family: Arial, Helvetica,sans-serif;font-size:13px;font-weight:bold;color:#'.$shared['redBail'].';margin: 0 0 10px 0;padding: 0 0 0 0;';
        $shared['paragraph']    = 'text-align:justify;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;color:#'.$shared['grayBail'].';margin:0 0 10px 0;padding:0;';
        $shared['soustitre']    = 'text-align:justify;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;font-style:italic;color:#666;margin:0 0 10px 0;padding:0 0 0 0;';
        $shared['listItem']     = 'text-align:justify;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;color:#1c1c1b;margin-bottom:5px;';
        $shared['tableReset']   = 'border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;margin: 0;padding: 0;';
        $shared['blocBorder']   = 'border-bottom:1px solid #ededed;';
        $shared['resetMarge']   = 'margin: 0;padding: 0;';
        $shared['linkGrey']     = 'color: #999; font-size: 11px; font-weight: normal; font-family: Helvetica, Arial, sans-serif;';

        /*
         * Building blocs
        */
        $shared['blocSpacer']       = '<tr bgcolor="ffffff"><td colspan="3" height="35"></td></tr>';
        $shared['blocSpacerBorder'] = '<tr bgcolor="ffffff"><td colspan="3" height="35" style="'.$shared['blocBorder'].'"></td></tr>';

        View::share( $shared );



    }

    public function index()
    {
        return View::make('newsletter.build');
    }


    public function campagne()
    {

        $content = $this->content->getByCampagne(1);

        return View::make('newsletter.show')->with(array('content' => $content));
    }


    /**
     * App views
     * @return mixed
     */

    public function buildingBlocs()
    {
        return View::make('newsletter.templates.building-blocs');
    }

    public function imageLeftText()
    {
        return View::make('newsletter.templates.image-left-text');
    }

    public function imageRightText()
    {
        return View::make('newsletter.templates.image-right-text');
    }

    public function imageText()
    {
        return View::make('newsletter.templates.image-text');
    }

    public function image()
    {
        return View::make('newsletter.templates.image');
    }

    public function text()
    {
        return View::make('newsletter.templates.text');
    }

    public function arret()
    {
        return View::make('newsletter.templates.arret');
    }

    public function convert()
    {
        return View::make('newsletter.show');
    }

    public function build()
    {
        $content = ( isset($_POST['content']) ? $_POST['content'] : '' );

        return View::make('newsletter.content')->with(array('content' => $content));
    }

    public function test()
    {

        $htmldoc = new InlineStyle(file_get_contents('http://newsletter.local/html'));
        $htmldoc->applyStylesheet($htmldoc->extractStylesheets());

        $html = $htmldoc->getHTML();

        return View::make('newsletter.test')->with(array('content' => $html));
    }

    public function upload()
    {
        $tempDir = __DIR__ . DIRECTORY_SEPARATOR . 'temp';

        if (!file_exists($tempDir)) {
            mkdir($tempDir);
        }

        if (Request::isMethod('get'))
        {
            $chunkDir  = $tempDir . DIRECTORY_SEPARATOR . Input::get('flowIdentifier');
            $chunkFile = $chunkDir.'/chunk.part'.Input::get('flowChunkNumber');

            if (file_exists($chunkFile)) {
                header("HTTP/1.0 200 Ok");
            } else {
                header("HTTP/1.0 404 Not Found");
            }
        }

        $files = $this->upload->upload( Input::file('file') , 'files' );

        if($files)
        {
            echo json_encode([
                'success' => true,
                'files'   => Input::file(),
                'get'     => Input::all(),
                'post'    => Input::all()
            ]);
        }

        return false;

    }

    public function process(){

        $data = Input::all();

        $contents = $this->content->create(array(
            'type_id'                => $data['type'],
            'titre'                  => $data['titre'],
            'contenu'                => $data['contenu'],
            'image'                  => $data['image'],
            'arret_id'               => 0,
            'categorie_id'           => 0,
            'newsletter_campagne_id' => 1,
            'rang'                   => 1
        ));

        print_r($contents);

    }

    /**
     * Return building blocs for js
     *
     * @return json
     */
    public function building()
    {
        return array( 'blocs' => $this->types->getAll());
    }

}
