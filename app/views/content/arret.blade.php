<div class="three-fourth">
    <div class="post">
        <div class="post-title">
            <?php setlocale(LC_ALL, 'fr_FR');  ?>
            <h2 class="title">{{ $bloc->reference }} du {{ $bloc->pub_date->formatLocalized('%d %B %Y') }}</h2>
            <p>{{ $bloc->abstract }}</p>
        </div><!--END POST-TITLE-->
        <div class="post-entry">
            {{ $bloc->pub_text }}
        </div>
    </div><!--END POST-->
</div>
<div class="one-fifth last listCat">
    <?php
    if(!$bloc->arrets_categories->isEmpty() )
    {
        foreach($bloc->arrets_categories as $categorie)
        {
            // Categories
            echo '<a href="#"><img width="130" border="0" alt="Loyer" src="'.asset('newsletter/pictos/'.$categorie->image).'"></a>';
        }
    }
    ?>
</div>
<span class="clear"></span>