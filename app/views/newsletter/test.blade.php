@extends('newsletter.layouts.master')
@section('content')

    <div class="row">
        <div class="col-md-9">

            <ul>
            <?php

                //$arrets = GetArret::all();

                if( !empty($arrets) )
                {
                    foreach($arrets as $arret)
                    {
                        $pubdate    = \Carbon\Carbon::createFromTimestamp($arret->pub_date)->toDateTimeString();
                        $createdate = $arret->created_at->toDateTimeString();
                        $updatedate = $arret->updated_at->toDateTimeString();

                        /*
                        $newarret = new \Droit\Content\Entities\Arret;
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

                //$categories = GetCategory::all();

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

                        /*
                        echo '<pre>';
                        print_r($categorie);
                        echo '</pre>';*/

                    }
                }


            //$analyses = GetAnalyse::all();

            if( !empty($analyses) )
            {
                foreach($analyses as $analyse)
                {
                    $pubdate    = \Carbon\Carbon::createFromTimestamp($analyse->pub_date)->toDateTimeString();
                    $createdate = $analyse->created_at->toDateTimeString();
                    $updatedate = $analyse->updated_at->toDateTimeString();

/*
                    $newanalyse = new \Droit\Content\Entities\Analyse;
                    $newanalyse->id         = $analyse->id;
                    $newanalyse->pid        = $analyse->pid;
                    $newanalyse->user_id    = $analyse->cruser_id;
                    $newanalyse->authors    = $analyse->authors;
                    $newanalyse->pub_date   = $pubdate;
                    $newanalyse->abstract   = $analyse->abstract;
                    $newanalyse->pub_text   = $analyse->pub_text;
                    $newanalyse->file       = $analyse->file;
                    $newanalyse->categories = $analyse->categories;
                    $newanalyse->arrets     = $analyse->arrets;
                    $newanalyse->created_at = $createdate;
                    $newanalyse->updated_at = $updatedate;

                    $newanalyse->save();

                    echo '<pre>';
                    print_r($newanalyse);
                    echo '</pre>';*/

                }
            }

            ?>
       </ul>

        </div>
        <div class="col-md-3">.col-md-4</div>
    </div>

@stop