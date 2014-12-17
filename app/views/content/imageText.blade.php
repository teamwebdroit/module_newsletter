<div class="post">
    <div class="post-title">
        <?php $lien = (isset($bloc->lien) && !empty($bloc->lien) ? $bloc->lien : url('/') ); ?>
        <a target="_blank" href="<?php echo $lien; ?>">
            <img style="max-width: 560px;margin: 0 auto; display: block;" alt="Droit du bail" src="{{ asset('files/'.$bloc->image) }}" />
        </a>
    </div><!--END POST-TITLE-->
    <div class="post-entry">
        {{ $bloc->contenu }}
    </div>
    <span class="clear"></span>
 </div>
