@extends('newsletter.layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-9">

            <ul>
            <?php

                /*
                $date = \Carbon\Carbon::createFromTimestamp(1294268400);
                echo '<pre>';
                print_r($date->toDateTimeString());
                echo '</pre>';
                */

                $arrets = GetArret::take(20)->get();

                if( !empty($arrets) )
                {
                    foreach($arrets as $arret)
                    {

                        $pubdate    = \Carbon\Carbon::createFromTimestamp($arret->pub_date)->toDateTimeString();
                        $createdate = $arret->created_at->toDateTimeString();
                        $updatedate = $arret->updated_at->toDateTimeString();

                        /*
                        $newarret = new \Droit\Arret\Entities\Arret;
                        $newarret->id         = $arret->id;
                        $newarret->pid        = $arret->pid;
                        $newarret->user_id    = $arret->cruser_id;
                        $newarret->reference  = $arret->reference;
                        $newarret->pub_date   = $pubdate;
                        $newarret->abstract   = $arret->abstract;
                        $newarret->pub_text   = $arret->pub_text;
                        $newarret->categories = $arret->categories;
                        $newarret->analysis   = $arret->analysis;
                        $newarret->created_at = $createdate;
                        $newarret->updated_at = $updatedate;

                        $newarret->save();
                        */

                        //print_r($arret);

                    }
                }

                $categories = GetCategory::all();

                if( !empty($categories) )
                {
                    foreach($categories as $categorie)
                    {
                        $createdate = $categorie->created_at->toDateTimeString();
                        $updatedate = $categorie->updated_at->toDateTimeString();

  /*                    $newcat = new \Droit\Categorie\Entities\Ba_categories;
                        $newcat->id         = $categorie->id;
                        $newcat->pid        = $categorie->pid;
                        $newcat->user_id    = $categorie->cruser_id;
                        $newcat->title      = $categorie->title;
                        $newcat->image      = $categorie->image;
                        $newcat->ismain     = $categorie->ismain;
                        $newcat->created_at = $createdate;
                        $newcat->updated_at = $updatedate;

                        $newcat->save();*/


                        echo '<pre>';
                        print_r($categorie);
                        echo '</pre>';

                    }
                }


            ?>
            </ul>

        </div>
        <div class="col-md-3">.col-md-4</div>
    </div>

@stop