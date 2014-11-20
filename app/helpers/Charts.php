<?php

class Charts{

    public function __construct()
    {
        $this->colors = array('#4f8edc','#85c744','#2bbce0','#f1c40f','#e73c3c','#4f5259','#c0392b','#76c4ed','#34495e','#16a085','#e73c68');
    }

    public function chartDoughnut($stats){

        $data['BouncedCount']      = $stats->Data[0]->BouncedCount;
        $data['ClickedCount']      = $stats->Data[0]->ClickedCount;
        $data['DeliveredCount']    = $stats->Data[0]->DeliveredCount;
        $data['OpenedCount']       = $stats->Data[0]->OpenedCount;
        $data['UnsubscribedCount'] = $stats->Data[0]->UnsubscribedCount;

        $doughnutData = array();

        $i = 0;
        foreach($data as $stat){
            $doughnutData[] = array('value' => $stat, 'color' => $this->colors[$i]);
            $i++;
        }

        return $doughnutData;
    }

    public function myBarChart($stats){

        $labels   = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet", "Août","Septembre","Octobre","Novembre","Décembre");
        $barChart = array();
        $list     = array();

        if(!empty($stats))
        {
            foreach($stats as $stat)
            {
                $date  = new \Carbon\Carbon($stat->CampaignSendStartAt);
                $month = $date->month -1;// compensate for array php start at 0
                $list[$month][] = $date->month;
            }
        }

        foreach (range(0, 11) as $i)
        {
            $barChart[$i] = (isset($list[$i]) ? count($list[$i]) : 0);
        }

        $data['labels']   = $labels;
        $data['datasets'][] = array(
            'fillColor'   => '#6faf30',
            'strokeColor' => '#669d31',
            'data'        => $barChart);

        return $data;

    }
}