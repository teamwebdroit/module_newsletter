<div class="row">
    <div class="col-md-9">
        <div class="post">
            <div class="post-title">
                <h2 class="title">{{ $bloc->titre }}</h2>
            </div><!--END POST-TITLE-->
            <div class="post-entry">
                {{ $bloc->contenu }}
            </div>
        </div><!--END POST-->
    </div>
    <div class="col-md-3 listCat">
        <?php $lien = (isset($bloc->lien) && !empty($bloc->lien) ? $bloc->lien : url('/') ); ?>
        <a target="_blank" href="<?php echo $lien; ?>">
            <img style="max-width: 130px; max-height: 200px;" alt="Droit du bail" src="{{ asset('files/'.$bloc->image.'') }}" />
        </a>
    </div>
</div>