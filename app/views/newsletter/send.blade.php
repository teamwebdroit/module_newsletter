@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <h3>Envoyer la campagne </h3>
    </div>
</div>

<div class="row">
    <div class="col-md-12">

        <div class="panel panel-inverse">
            <div class="panel-heading">
                <h4><i class="fa fa-rocket"></i> &nbsp;</h4>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12">
                <?php $charts = new \Charts; ?>

                <?php
                    list($list,$max) = $charts->allYearStats($statsListe);

                    echo '<pre>';
                    print_r($list);
                    echo '</pre>';

                    echo '<div class="chart">';
                        echo '<div class="chart-ruler">';
                        echo '<span class="min">0</span>';

                        foreach (range(1, $max) as $ruler)
                        {
                            if($max != $ruler){
                                echo '<span>'.$ruler.'</span>';
                            }
                            else{
                                echo '<span class="max">'.$ruler.'</span>';
                            }
                        }
                        echo '</div>';

                        if(!empty($list))
                        {
                            foreach($list as $year => $stat)
                            {
                                foreach (range(1, 12) as $i)
                                {
                                    echo '<div class="column">';
                                    /*$daysmonth = cal_days_in_month(CAL_GREGORIAN, $i, $year);*/
                                    echo '<p>'.$charts->labels[$i].'</p>';
                                    if(isset($stat[$i]))
                                    {
                                        foreach($stat[$i] as $daynumber => $day)
                                        {
                                            if(!empty($day))
                                            {
                                                $DeliveredCount = 0;
                                                $ClickedCount   = 0;
                                                $OpenedCount    = 0;

                                                foreach($day as $statday)
                                                {
                                                    $DeliveredCount += $statday['DeliveredCount'];
                                                    $ClickedCount   += $statday['ClickedCount'];
                                                    $OpenedCount    += $statday['OpenedCount'];
                                                }

                                                $data[1] = $DeliveredCount;
                                                $data[2] = $ClickedCount/$DeliveredCount * 100;
                                                $data[3] = $OpenedCount/$DeliveredCount * 100;
                                                foreach (range(1, 3) as $nbr)
                                                {
                                                    echo '<div class="inner-column">';
                                                        echo '<div class="fill" style="height:'.$data[$nbr].'%;background: '.$charts->colors[$nbr].'"></div>';
                                                    echo '</div>';
                                                }
                                            }
                                        }
                                    }
                                    echo '</div>';
                                }
                            }
                        }

                    echo '</div>';
                    ?>

                    </div>
                </div>

                <script type="text/javascript">
                    window.onload = function(){
                        $.plot($("#interactive"), <?php echo json_encode($charts->myPieChart($statistiques)); ?>,
                        {
                            series: {
                                pie: { show: true}
                            },
                            grid: {
                                hoverable: true,
                                clickable: true
                            },
                            legend: { show: false }
                        });

                        var barChartData = {
                            //labels : ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"],
                            labels : ["Janvier","Février","Mars","Avril","Mai","Juin","Juillet"],
                            datasets : [
                                {
                                    fillColor : "rgba(220,220,220,0.5)",
                                    strokeColor : "rgba(220,220,220,1)",
                                    data : [65,59,90,81,56,55,40]
                                },
                                {
                                    fillColor : "rgba(151,187,205,0.5)",
                                    strokeColor : "rgba(151,187,205,1)",
                                    data : [28,48,40,19,96,27,100]
                                }
                            ]
                        }

                        var myLine = new Chart(document.getElementById("bar-chart").getContext("2d")).Bar(barChartData);
                    };
                </script>

                <div class="row">
                    <div class="col-md-12 col-lg-12">
                        <div class="panel panel-inverse">
                            <div class="panel-heading">
                                <h4>Bar Chart</h4>
                            </div>
                            <div class="panel-body">
                                <canvas id="bar-chart" height="300"  width="600"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-4">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4>Interactive</h4>
                            </div>
                            <div class="panel-body">
                                <div id="interactive" style="width:100%; height: 300px" class="centered"></div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
</div>

@stop