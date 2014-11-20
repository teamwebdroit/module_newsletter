<?php

class Charts{

    public function __construct()
    {
        $this->colors = array('#4f8edc','#85c744','#2bbce0','#f1c40f','#e73c3c','#4f5259','#c0392b','#76c4ed','#34495e','#16a085','#e73c68','#b8c6d5');
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

        $data['labels'] = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
        $barChart       = array();
        $list           = array();

        if(!empty($stats))
        {
            foreach($stats as $stat)
            {
                $date  = new \Carbon\Carbon($stat->CampaignSendStartAt);
                $month = $date->month -1;// compensate for array php start at 0
                $list['DeliveredCount'][$month][$stat->CampaignID] = $stat->DeliveredCount;
                $list['ClickedCount'][$month][$stat->CampaignID]   = $stat->ClickedCount;
                $list['OpenedCount'][$month][$stat->CampaignID]    = $stat->OpenedCount;
            }
        }
/*
        $bars = array();

        foreach($list as $name => $bar)
        {
            $data = array();

            foreach (range(0, 11) as $i)
            {
                foreach($list as $month => $campagne)
                {
                    if($month == $i)
                    {
                        foreach($campagne as $count){
                            $barChart[] = $count;
                        }
                    }
                    else{
                    }
                }
            }

            $data['datasets'][] = array( 'fillColor' => '#bad3a1', 'strokeColor' => '#669d31', 'data' => $barChart );
            $bars[$name][] =
        }
*/


        //$data['datasets'][] = array( 'fillColor' => '#bad3a1', 'strokeColor' => '#669d31', 'data' => $barChart );

        return $list;

    }

    public function myPieChart($stats){

        if(!empty($stats))
        {
            // Calculations
            $sent   = $stats->DeliveredCount;
            $clic   = $stats->ClickedCount/$sent;
            $open   = $stats->OpenedCount/$sent;
            $bounce = $stats->BouncedCount/$sent;

            if($open != $clic){
                $data[] = array('label' => 'Cliqués', 'data' => $clic);
                $data[] = array('label' => 'Ouverts',  'data' => $open);
            }
            else
            {
                $data[] = array('label' => 'Ouverts et Cliqués', 'data' => $clic);
            }

            $data[] = array('label' => 'Refusés', 'data' => $bounce);
        }

        return $data;

    }

}