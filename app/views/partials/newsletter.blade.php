<div class="newsletter">
    <h3 class="title"><i class="icon-envelope"></i> &nbsp;Inscription à la newsletter</h3>
    {{ Form::open(array('url' => 'inscription')) }}
        <input id="newsletter" type="text" size="30" value="" name="email" placeholder="Entrez votre email">
        <button type="submit" class="button small grey">Envoyer</button>
    {{ Form::close() }}
</div><!--END WIDGET-->

<p class="divider-border"></p>