<?php  $cats = implode(' ',$post->allcats); ?>
<div class="arret <?php echo $cats; ?> clear">

    <div class="three-fourth">
        <div class="post">
            <div class="post-title">
                <h2 class="title">{{ $post->humanTitle }}</h2>
                <p>{{ $post->abstract }}</p>
            </div><!--END POST-TITLE-->
            <div class="post-entry">
                {{ $post->parsedText }}
            </div>
        </div><!--END POST-->
    </div>
    <div class="one-fifth last listCat">

        @if(!$post->arrets_categories->isEmpty())
            @foreach($post->arrets_categories as $categorie)
                <img width="110" border="0" alt="{{ $categorie->title }}" src="<?php echo asset('newsletter/pictos') ?>/{{ $categorie->image }}">
                <p class="centerText">{{ $categorie->title }}</p>
            @endforeach
        @endif

    </div>
    <span class="clear"></span>

</div>