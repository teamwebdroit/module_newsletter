<div class="three-fourth">
    <div class="post">
        <div class="post-title">
            <h2 class="title">{[{ post.humanTitle }]}</h2>
            <p>{[{ post.abstract }]}</p>
        </div><!--END POST-TITLE-->
        <div class="post-entry">
            <div ng-bind-html='post.parsedText'></div>
        </div>
    </div><!--END POST-->
</div>
<div class="one-fifth last listCat">
    <div ng-repeat="categorie in post.arrets_categories">
        <img width="130" border="0" alt="{[{ categorie.title }]}" src="<?php echo asset('newsletter/pictos') ?>/{[{ categorie.image }]}">
    </div>
</div>
<span class="clear"></span>