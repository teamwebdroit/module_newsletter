<?php $custom = new \Custom; ?>

<div class="newsletter">
    <h3 class="title"><i class="icon-envelope"></i> &nbsp;Inscription à la newsletter</h3>
    <input id="newsletter" type="text" size="30" value="" name="newsletter" placeholder="Entrez votre email">
    <a href="#" class="button small grey">Envoyer</a>
</div><!--END WIDGET-->

<p class="divider-border"></p>

<div class="widget">
    <h3 class="title"><i class="icon-edit"></i> &nbsp;Derniers arrêts</h3>
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

<!--<div class="widget">
    <h3 class="title">Catégories</h3>
    <ul class="bra_categories">

        @if(!$categories->isEmpty())
            @foreach($categories as $categorie)
                <li><a href="{{ url('categorie/'.$categorie->id) }}">{{ $categorie->title }}</a></li>
            @endforeach
        @endif

    </ul>
</div>-->
<!--END WIDGET-->

