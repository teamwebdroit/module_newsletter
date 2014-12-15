<?php $custom = new \Custom; ?>

<div class="widget">
    <h3 class="title"><i class="icon-edit"></i> &nbsp;Derniers arrêts</h3>
    <ul class="bra_recent_entries">

        @if(!$latest->isEmpty())
            @foreach($latest as $last)
                <li>
                    <span class="date">{{ $last->pub_date->formatLocalized('%d %B %Y') }}</span>
                    <a href="{{ url('jurisprudence').'/#'.$last->reference }}">{{ $last->reference }}</a>
                    <p>{{ $custom->limit_words($last->abstract,10) }}</p>
                </li>
            @endforeach
        @endif

    </ul><!--END UL-->
</div><!--END WIDGET-->

