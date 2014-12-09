<?php namespace Droit\Newsletter\Worker;

use Droit\Categorie\Repo\CategorieInterface;
use Droit\Content\Repo\ArretInterface;

class NewsletterWorker{

    protected $categories;
    protected $arret;
    protected $custom;

    /* Inject dependencies */
    public function __construct(  CategorieInterface $categories, ArretInterface $arret)
    {
        $this->categories = $categories;
        $this->arret      = $arret;
        $this->custom     = new \Custom;
    }

    /**
     * Return response arrets prepared for filtered
     *
     * @return response
     */
    public function preparedAnnees()
    {
        $arrets   = $this->arret->getAll(195);
        $prepared = $arrets->lists('pub_date');

        foreach($prepared as $arret)
        {
            $years[] = $arret->year;
        }

        return array_reverse(array_unique(array_values($years)));

    }

    /**
     * Return response arrets prepared for filtered
     *
     * @return response
     */
    public function preparedArrets()
    {

        $arrets   = $this->arret->getAll(195);

        $prepared = $arrets->filter(function($arret)
        {
            // format the title with the date
            setlocale(LC_ALL, 'fr_FR');

            $arret->setAttribute('humanTitle',$arret->reference.' du '.$arret->pub_date->formatLocalized('%d %B %Y'));
            $arret->setAttribute('parsedText',$arret->pub_text);

            // categories for isotope
            if(!$arret->arrets_categories->isEmpty())
            {
                foreach($arret->arrets_categories as $cat){ $cats[] = 'c'.$cat->id; }

                $cats[]  = 'y'.$arret->pub_date->year;
                $arret->setAttribute('allcats',$cats);

                return $arret;
            }
            else
            {
                $cats[]  = 'y'.$arret->pub_date->year;
                $arret->setAttribute('allcats',$cats);

                return $arret;
            }

        });

        $prepared->sortBy('id');
        $prepared->values();

        return $prepared;
    }

}