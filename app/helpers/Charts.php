<?php

class Charts{

    public $colors;
    public $labels;

    public function __construct()
    {
        $this->colors = array('#85c744','#f1c40f','#e73c3c','#4f5259','#c0392b','#4f8edc','#85c744','#2bbce0','#76c4ed','#34495e','#16a085','#e73c68','#b8c6d5');
        $this->labels = array(
            1  => "Janvier",
            2  => "Février",
            3  => "Mars",
            4  => "Avril",
            5  => "Mai",
            6  => "Juin",
            7  => "Juillet",
            8  => "Août",
            9  => "Septembre",
            10 => "Octobre",
            11 => "Novembre",
            12 => "Décembre");
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

    public function allYearStats($stats){

        $list = array();
        $max  = 0;

        if(!empty($stats->Data))
        {
            foreach($stats->Data as $stat)
            {
                if( isset($stat->NewsLetterID))
                {
                    $date  = new \Carbon\Carbon($stat->CampaignSendStartAt);
                    $year  = $date->year;
                    $month = $date->month;
                    $day   = $date->day;

                    $list[$year][$month][$day][$stat->CampaignID]['DeliveredCount'] = $stat->DeliveredCount;
                    $list[$year][$month][$day][$stat->CampaignID]['ClickedCount']   = $stat->ClickedCount;
                    $list[$year][$month][$day][$stat->CampaignID]['OpenedCount']    = $stat->OpenedCount;

                    // Set max if bigger
                    if($stat->DeliveredCount > $max ){
                        $max = $stat->DeliveredCount;
                    }
                }
            }
        }

        return array($list, $max);
    }



    public function myPieChart($stats){

        if(!empty($stats))
        {
            // Calculations
            $sent    = 10; // $stats->DeliveredCount;

            $clic    = 4; // $stats->ClickedCount/$sent;
            $open    = 6; // $stats->OpenedCount/$sent;
            $bounce  = 1; // $stats->BouncedCount/$sent;
            $nonopen = $sent - ($open + $bounce);

            if($open != $clic){
                $data[] = array('label' => 'Cliqués', 'data' => $clic);
                $data[] = array('label' => 'Ouverts',  'data' => $open);
            }
            else
            {
                $data[] = array('label' => 'Ouverts et Cliqués', 'data' => $clic);
            }

            $data[] = array('label' => 'Refusés', 'data' => $bounce);
            $data[] = array('label' => 'Non ouvert', 'data' => $nonopen);
        }

        return $data;

    }

}