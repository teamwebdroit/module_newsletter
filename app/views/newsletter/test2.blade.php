@extends('newsletter.layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-9">

            <?php

                $date = \Carbon\Carbon::createFromTimestamp(1294268400);
                echo '<pre>';
                print_r($date->toDateTimeString());
                echo '</pre>';

                $arrets = GetArret::all();

                echo '<pre>';
                print_r($arrets);
                echo '</pre>';

                function cleanParagraph($text, $tagname){
                    return strip_tags ( $text , '<strong><b><i><a><img><ul><li><ol><br>' );
                }
                function stylePragraph($text, $tag, $style){
                    return str_replace($tag, $tag.' style="'.$style.'"',$text);
                }

                $text = '<p class="align-justify" style="text-align:justify;font-family:Arial, Helvetica, sans-serif;font-size:12px;font-weight:normal;color:#303030;margin:0 0 12px 0;padding:0;">Text <a href="#">link</a> <img src="vre" /> <strong>to</strong> find</p>';
                $clean = cleanParagraph($text,'p');
                //echo '<pre>';print_r($clean); echo '</pre>';
                $new = '<p>Text <a href="#">link</a> <strong>to</strong> find</p>';
                //echo stylePragraph($new, '<p', 'text-align:left;font-family:Arial,sans-serif;font-size:18px;color:#ddd;');
            ?>


        </div>
        <div class="col-md-3">.col-md-4</div>
    </div>


@stop