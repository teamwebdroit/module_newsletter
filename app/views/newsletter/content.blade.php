@extends('newsletter.layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-9">

            @if(!empty($content))
                <?php

                function explodeTags($tags) {
                    // This regexp allows the following types of user input:
                    // this, "somecompany, llc", "and ""this"" w,o.rks", foo bar
                    $regexp = '%(?:^|,\ *)("(?>[^"]*)(?>""[^"]* )*"|(?: [^",]*))%x';
                    preg_match_all($regexp, $tags, $matches);
                    $typed_tags = array_unique($matches[1]);

                    $tags = array();
                    foreach ($typed_tags as $tag) {
                        // If a user has escaped a term (to demonstrate that it is a group,
                        // or includes a comma or quote character), we remove the escape
                        // formatting so to save the term into the database as the user intends.
                        $tag = trim(str_replace('""', '"', preg_replace('/^"(.*)"$/', '\1', $tag)));
                        if ($tag != "") {
                            $tags[] = $tag;
                        }
                    }

                    return $tags;
                }

                    echo '<pre>';
                    print_r(explodeTags($content));
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