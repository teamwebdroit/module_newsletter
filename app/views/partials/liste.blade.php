<?php $custom = new \Custom; ?>

<div class="widget">
    <h3 class="title"><i class="icon-envelope"></i> &nbsp;Newsletter</h3>
    <ul class="bra_recent_entries">
        
        @if(!$listCampagnes->isEmpty())
            @foreach($listCampagnes as $campagnes)
                <li>
                    <span class="date">{{ $campagnes->created_at->formatLocalized('%d %B %Y') }}</span>
                    <a href="#">{{ $campagnes->sujet }}</a>
                    <p>{{ $campagnes->auteurs }}</p>
                </li>
            @endforeach
        @endif

    </ul><!--END UL-->
</div><!--END WIDGET-->

<p class="divider-border"></p>

<div class="newsletter">
    <h3 class="title"><i class="icon-envelope"></i> &nbsp;Inscription à la newsletter</h3>
    <input id="newsletter" type="text" size="30" value="" name="newsletter" placeholder="Entrez votre email">
    <a href="#" class="button small grey">Envoyer</a>
</div><!--END WIDGET-->
