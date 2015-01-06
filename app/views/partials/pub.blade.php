@if(!$pub->isEmpty())

<div class="widget">
    <h3 class="title"><i class="glyphicon glyphicon-pushpin"></i> &nbsp;New</h3>

    @foreach($pub as $ad)

        @if( isset($ad->titre) && isset($ad->url) && isset($ad->image))
            <div class="media">
                <a class="media-left" target="_blank" href="{{ $ad->url }}">
                    <img src="{{ url('files').'/'.$ad->image }}" alt="{{{ $ad->titre or 'image' }}}" />
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{ $ad->titre }}</h4>
                    {{ $ad->contenu or '' }}
                    <a class="button small grey" target="_blank" href="{{ $ad->url }}">En savoir plus</a>
                </div>
            </div>
        @elseif(isset($ad->url) && isset($ad->image))
            <a target="_blank" href="{{ $ad->url }}">
                <img src="{{ url('files').'/'.$ad->image }}" alt="{{{ $ad->titre or 'image' }}}" />
            </a>
        @elseif(isset($ad->image))
            <img src="{{ url('files').'/'.$ad->image }}" alt="{{{ $ad->titre or 'image' }}}" />
        @endif

    @endforeach

</div><!--END WIDGET-->

<p class="divider-border"></p>
@endif