@if(!$soutiens->isEmpty())

    <div class="widget soutiens">
        <h3 class="title"><i class="glyphicon glyphicon-star-empty"></i> &nbsp;Avec le soutien de</h3>

        @foreach($soutiens as $soutien)
            @if(isset($soutien->url) && isset($soutien->image))
                <div class="media">
                    <a target="_blank" href="{{{ $soutien->url or '#' }}}">
                        <img src="{{ url('files/'.$soutien->image.'')}}" alt="Soutiens" />
                    </a>
                </div>
            @endif
        @endforeach

    </div><!--END WIDGET-->

    <p class="divider-border"></p>
@endif