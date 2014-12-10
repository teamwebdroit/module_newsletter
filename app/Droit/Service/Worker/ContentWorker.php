<?php namespace Droit\Service\Worker;

use Droit\Categorie\Repo\CategorieInterface;
use Droit\Content\Repo\ArretInterface;
use Droit\Content\Repo\AnalyseInterface;

class ContentWorker{

    protected $categories;
    protected $arret;
    protected $analyse;
    protected $custom;

    /* Inject dependencies */
    public function __construct(  CategorieInterface $categories, ArretInterface $arret, AnalyseInterface $analyse)
    {
        $this->categories = $categories;
        $this->arret      = $arret;
        $this->analyse    = $analyse;
        $this->custom     = new \Custom;
    }

    /**
     * Return collection arrets prepared for filtered
     *
     * @return collection
     */
    public function dispatchMainCategories($arrets)
    {
        $categories = $this->categories->getAllMain(195);



    }

    /**
     * Return collection arrets prepared for filtered
     *
     * @return collection
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
     * @return collection
     */
    public function preparedArrets()
    {

        $arrets   = $this->arret->getAll(195);

        $prepared = $arrets->filter(function($arret)
        {
            // format the title with the date
            setlocale(LC_ALL, 'fr_FR.UTF-8');
            //setlocale (LC_TIME, 'fr_FR.UTF8');

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

        $prepared->sortByDesc('pub_date');
        $prepared->values();

        return $prepared;
    }

    /**
     * Return collection analyses prepared for filtered
     *
     * @return collection
     */
    public function preparedAnalyses()
    {

        $analyses = $this->analyse->getAll(195);

        $prepared = $analyses->filter(function($analyse)
        {
            // format the title with the date
            setlocale(LC_ALL, 'fr_FR');

            // categories for isotope
            if(!$analyse->analyses_categories->isEmpty())
            {
                foreach($analyse->analyses_categories as $cat){ $cats[] = 'c'.$cat->id; }

                $cats[]  = 'y'.$analyse->pub_date->year;
                $analyse->setAttribute('allcats',$cats);

                return $analyse;
            }
            else
            {
                $cats[]  = 'y'.$analyse->pub_date->year;
                $analyse->setAttribute('allcats',$cats);

                return $analyse;
            }

        });

        $prepared->sortByDesc('pub_date');
        $prepared->values();

        return $prepared;
    }

}