@extends('layouts.admin')
@section('content')

<?php
$charts = new \Charts;
list($list,$max) = $charts->allYearStats($statistiques);
?>

<div class="row">
    <div class="col-md-12">
        <h3>Statistiques d'envois</h3>
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
                        <ul id="chart-data">
                            <li>Envoyés <span style="background: <?php echo $charts->colors[1]; ?>;"></span></li>
                            <li>Ouverts <span style="background: <?php echo $charts->colors[2]; ?>;"></span></li>
                            <li>Cliqués <span style="background: <?php echo $charts->colors[3]; ?>;"></span></li>
                            <li>Refusés <span style="background: <?php echo $charts->colors[4]; ?>;"></span></li>
                        </ul>
                    </div>
                </div>
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
                                                $BouncedCount   = 0;

                                                foreach($day as $statday)
                                                {
                                                    $DeliveredCount += $statday['DeliveredCount'];
                                                    $ClickedCount   += $statday['ClickedCount'];
                                                    $OpenedCount    += $statday['OpenedCount'];
                                                    $BouncedCount   += $statday['BouncedCount'];
                                                }

                                                if($DeliveredCount > 0)
                                                {
                                                    $data[1] = ($DeliveredCount/$DeliveredCount) * 100;
                                                    $data[2] = ($ClickedCount/$DeliveredCount) * 100;
                                                    $data[3] = ($OpenedCount/$DeliveredCount) * 100;
                                                    $data[4] = ($BouncedCount/$DeliveredCount) * 100;

                                                    foreach (range(1, 3) as $nbr)
                                                    {
                                                        echo '<div class="inner-column">';
                                                            echo '<div class="fill" style="height:'.$data[$nbr].'%;background: '.$charts->colors[$nbr].'"></div>';
                                                        echo '</div>';
                                                    }

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


@stop