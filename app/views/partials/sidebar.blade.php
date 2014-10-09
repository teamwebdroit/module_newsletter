<?php  $custom = new \Custom; ?>

<div id="sidebar">
    <div class="widget">
        <h3 class="title">Filtres</h3>
        <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,
            totam rem aperiam, eaque ipsa inventore veritatis et quasi architecto.</p>
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
