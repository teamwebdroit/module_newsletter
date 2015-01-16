<?php namespace Droit\Content\Worker;


class ArretWorker{

    public function __construct()
    {
        $this->custom  = new \Custom;
    }

    public function getAnalyseForArret($arret){

        if(!$arret->arrets_analyses->isEmpty()){

            return $arret->arrets_analyses;
        }

        return [];
    }

}