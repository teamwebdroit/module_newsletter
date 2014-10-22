<div class="three-fourth">
    <div class="post">
        <div class="post-title">
            <h2 class="title">{{ $bloc->titre }}</h2>
        </div><!--END POST-TITLE-->
        <div class="post-entry">
            {{ $bloc->contenu }}
        </div>
    </div><!--END POST-->
</div>
<div class="one-fifth last listCat">
    <a href="#"><img style="max-width: 130px; max-height: 220px;" alt="Droit du bail" src="{{ asset('files/'.$bloc->image.'') }}" /></a>
</div>
<span class="clear"></span>