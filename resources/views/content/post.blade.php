<?php  $cats = implode(' ',$post->allcats); ?>
<div class="arret <?php echo $cats; ?> clear">
    <div class="row">

        <div class="col-md-9">
            <div class="post">
                <div class="post-title">
                    <h3 class="title">{{ $post->humanTitle }}</h3>
                    <p>{{ $post->abstract }}</p>
                </div><!--END POST-TITLE-->
                <div class="post-entry">
                    <a class="anchor" name="{{ $post->reference }}"></a>
                    {{ $post->parsedText }}

                    @if(!empty($post->file ))
                    <p><a target="_blank" href="{{ asset('files/arrets/'.$post->file) }}">
                         Télécharger en pdf &nbsp;&nbsp;<i class="fa fa-file-pdf-o"></i>
                    </a></p>
                    @endif
                </div>
            </div><!--END POST-->
        </div>
        <div class="col-md-3 listCat">
            @if(!$post->arrets_categories->isEmpty())
                @foreach($post->arrets_categories as $categorie)
                    <img border="0" alt="{{ $categorie->title }}" src="<?php echo asset('newsletter/pictos') ?>/{{ $categorie->image }}">
                @endforeach
            @endif
        </div>

    </div>
</div>