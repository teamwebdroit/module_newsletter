@extends('newsletter.layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-9">

            @if(!empty($content))
                <?php
                    $content = htmlspecialchars(nl2br ($content ));
                    echo '<pre>';
                    print_r($content);
                    echo '</pre>';
                ?>
            @endif

            {{ Form::open(array( 'url' => 'build', 'class' => 'form-horizontal')) }}

                <div class="form-group">
                    <label for="text" class="col-sm-2 control-label">Texte</label>
                    <div class="col-sm-10">
                        <textarea id="content" name="content" class="form-control" rows="10"></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Envoyer</button>
                    </div>
                </div>

            {{ Form::close() }}

        </div>
        <div class="col-md-3">.col-md-4</div>
    </div>

@stop