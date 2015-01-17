<?php namespace Droit\Newsletter\Worker;

use Droit\Newsletter\Repo\NewsletterContentInterface;
use Droit\Newsletter\Repo\NewsletterCampagneInterface;
use Droit\Content\Repo\ArretInterface;
use Droit\Categorie\Repo\CategorieInterface;
use Droit\Content\Repo\GroupeInterface;
use \InlineStyle\InlineStyle;

class CampagneWorker implements CampagneInterface{

    protected $content;
    protected $campagne;
    protected $arret;
    protected $categorie;
    protected $worker;
    protected $groupe;

	public function __construct(NewsletterContentInterface $content,NewsletterCampagneInterface $campagne, ArretInterface $arret, CategorieInterface $categorie , GroupeInterface $groupe)
	{
        $this->content   = $content;
        $this->campagne  = $campagne;
        $this->arret     = $arret;
        $this->categorie = $categorie;
        $this->groupe    = $groupe;
        $this->worker    = new \Droit\Content\Worker\ArretWorker();
	}

    public function getCampagne($id){

        return $this->campagne->find($id);
    }

    public function getCategoriesArrets(){
        return $this->categorie->getAll(195)->lists('title','id');
    }

	public function findCampagneById($id){

        $content  = $this->content->getByCampagne($id);

        if(!$content->isEmpty()){

            $campagne = $content->map(function($item)
            {
                if ($item->arret_id > 0)
                {
                    $arret = $this->arret->find($item->arret_id);

                    if($arret->dumois)
                    {
                        $analyses = $this->worker->getAnalyseForArret($arret);
                        $arret->setAttribute('analyses',$analyses);
                    }

                    $arret->setAttribute('type',$item->type);
                    $arret->setAttribute('rangItem',$item->rang);
                    $arret->setAttribute('idItem',$item->id);

                    return $arret;
                }
                elseif($item->groupe_id > 0){

                    $groupe       = $this->groupe->find($item->groupe_id);
                    $group_arrets = $groupe->arrets_groupes->lists('id');

                    $arrets    = $this->arret->find($group_arrets);
                    $categorie = $groupe->categorie_id;

                    $image = $this->categorie->find($categorie);
                    $image = $image->image;

                    $item->setAttribute('arrets',$arrets);
                    $item->setAttribute('categorie',$categorie);
                    $item->setAttribute('image',$image);
                    $item->setAttribute('rangItem',$item->rang);
                    $item->setAttribute('idItem',$item->id);

                    return $item;
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

        return [];
	}

    public function html($id)
    {
        $htmldoc = new InlineStyle(file_get_contents( url('campagne/'.$id)));
        $htmldoc->applyStylesheet($htmldoc->extractStylesheets());

        $html = $htmldoc->getHTML();
        $html = preg_replace('#<script(.*?)>(.*?)</script>#is', '', $html);

        return $html;
    }

}
