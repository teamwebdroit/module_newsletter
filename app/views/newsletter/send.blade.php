@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-12">
        <h3>Statistiques de la campagne </h3>
    </div>
</div>

<?php
    $charts = new \Charts;
    list($list,$max) = $charts->allYearStats($statsListe);
?>

<div class="row">
    <div class="col-md-12">


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
            };
        </script>

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

        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-inverse">
                    <div class="panel-heading">
                        <h4><i class="fa fa-rocket"></i> &nbsp;</h4>
                    </div>
                    <div class="panel-body">
                        <div class="chart">
                        <?php
                                echo '<div class="chart-ruler">';
                                    echo '<span class="min">0</span>';
                                    foreach (range(1, $max) as $ruler)
                                    {
                                        echo ($max != $ruler ? '<span>'.$ruler.'</span>' : '<span class="max">'.$ruler.'</span>');
                                    }
                                echo '</div>';

                                if(!empty($list))
                                {
                                    foreach($list as $year => $stat)
                                    {
                                        foreach (range(1, 12) as $i)
                                        {
                                            echo '<div class="column">';
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

                            ?>
                        </div>
                    </div>
                </div>


            </div>
        </div>

    </div>
</div>

@stop