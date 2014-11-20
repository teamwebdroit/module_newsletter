<?php namespace Droit\Newsletter\Worker;

class StatsWorker{

    public function getTotalCount($data){

        return $stats = $data->Count;
    }

    public function filterResponseStatistics($data){

        $stats = $data->Data[0];
        //$stats = new \Illuminate\Support\Collection( (array) $stats);

        return $stats;
    }

}