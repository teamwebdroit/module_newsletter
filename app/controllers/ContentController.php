<?php

use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;
use Droit\Newsletter\Repo\NewsletterContentInterface;

class ContentController extends \BaseController {

    protected $arret;
    protected $categorie;
    protected $content;
    protected $custom;

    public function __construct( ArretInterface $arret, CategorieInterface $categorie ,NewsletterContentInterface $content)
    {
        $this->arret     = $arret;
        $this->categorie = $categorie;
        $this->content   = $content;
        $this->custom    = new \Custom;
    }

	/**
	 * Display a listing of the resource.
	 * GET /content
	 *
	 * @return Response
	 */
	public function campagne($id)
	{
        $content  = $this->content->getByCampagne($id);

        $campagne = $content->map(function($item)
        {
            if ($item->arret_id > 0)
            {
                $arret = $this->arret->find($item->arret_id);
                $arret->setAttribute('type',$item->type);
                $arret->setAttribute('rangItem',$item->rang);
                $arret->setAttribute('idItem',$item->id);
                return $arret;
            }
            else
            {
                $item->setAttribute('rangItem',$item->rang);
                $item->setAttribute('idItem',$item->id);
                return $item;
            }
        });

        return $campagne;
	}

}