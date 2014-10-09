<?php  $custom = new \Custom; ?>

<div id="sidebar">
    <div class="widget">
        <h3 class="title">Dernière édition RJN</h3>
        <p><img width="160" border="0" alt="RJN" src="{{ asset('edition/rjn.png') }}"></p>
        <p class="text-align-left">
            <a class="button small grey" href="#">Commander</a>
        </p>
    </div><!--END WIDGET-->

    <div class="widget">
        <h3 class="title">Derniers arrêts</h3>
        <ul class="bra_recent_entries">

            @if(!$latest->isEmpty())
                @foreach($latest as $last)
                    <li>
                        <span class="date">{{ $last->pub_date->formatLocalized('%d %B %Y') }}</span>
                        <a href="#">{{ $last->reference }}</a>
                        <p>{{ $custom->limit_words($last->abstract,15) }}</p>
                    </li>
                @endforeach
            @endif

        </ul><!--END UL-->
    </div><!--END WIDGET-->

    <div class="widget">
        <h3 class="title">Catégories</h3>
        <ul class="bra_categories">

            @if(!$categories->isEmpty())
                @foreach($categories as $categorie)
                    <li><a href="{{ url('categorie/'.$categorie->id) }}">{{ $categorie->title }}</a></li>
                @endforeach
            @endif

        </ul><!--END UL-->
    </div><!--END WIDGET-->

</div><!--END SIDEBAR-->
