<?php namespace Droit\Newsletter\Worker;

class StatsWorker{

    public function getTotalCount($data){

        return $stats = $data->Count;
    }

    public function filterResponseStatistics($data){

        $stats = (isset($data->Data[0]) ? $data->Data[0] : false);

        return $stats;
    }

    public function filterResponseStatisticsMany($data){

        $stats = ($data->Data ? $data->Data : false);

        return $stats;
    }

    public function aggregateStatsClicksLinks($data){

        $clicks = array();

        if(!empty($data))
        {
            foreach($data as $click)
            {
                $clicks[$click->Url][] = $click->ContactID;
            }
        }

        return $clicks;
    }
}