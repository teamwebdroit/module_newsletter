<!--
<div class="widget">
    <h3 class="title"><i class="glyphicon glyphicon-pushpin"></i> &nbsp;New</h3>
    @if(isset($pub))

        <div class="media">
            <a class="media-left" target="_blank" href="{{ $pub->url }}">
                <img src="{{ url('files').'/'.$pub->image }}" alt="{{ $pub->titre }}" />
            </a>
            <div class="media-body">
                <h4 class="media-heading">{{ $pub->titre }}</h4>
                {{ $pub->contenu }}
                <a class="button small grey" target="_blank" href="{{ $pub->url }}">Acheter</a>
            </div>
        </div>

    @endif
</div><!--END WIDGET-->

<div class="widget">
    <h3 class="title"><i class="glyphicon glyphicon-pushpin"></i> &nbsp;New</h3>
    <img src="{{ url('images/holder2.jpg') }}" alt="" />
</div>

<p class="divider-border"></p>
