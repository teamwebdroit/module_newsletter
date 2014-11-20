<?php namespace Droit\Newsletter\Worker;

class StatsWorker{

    public function getTotalCount($data){

        return $stats = $data->Count;
    }

    public function filterResponseStatistics($data){

        $stats = $data->Data;
        $stats = new \Illuminate\Support\Collection( (array) $stats);

        $statscampagnes = $stats->filter(function($campagne)
        {
            if(isset($campagne->NewsLetterID)){
                return $campagne;
            }
        });

        return $statscampagnes;

    }

}