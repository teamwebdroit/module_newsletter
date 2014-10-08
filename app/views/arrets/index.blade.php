@extends('layouts.admin')
@section('content')

<?php  $custom = new Custom; ?>

    <div id="page-heading">
        <h1>Arrêts</h1>
        <div class="options">
            <div class="btn-toolbar">
                <a href="{{ url('admin/arrets/create/'.$pid) }}" class="btn btn-default"><i class="fa fa-plus"></i> &nbsp;Ajouter arrêt</a>
            </div>
        </div>
    </div>

    <div class="container">

    <!-- Arrets bail -->
        <div class="row">
          <div class="col-md-12">

              <div class="panel panel-sky">
                  <div class="panel-body collapse in">

                        <h3 class="text-center">
                            @if ( $pid == 195 )
                                {{HTML::image('/images/bail/logo.png')}}
                            @endif
                            @if ( $pid == 207 )
                                {{HTML::image('/images/admin/matrimonial.jpg')}}
                            @endif
                        </h3>

                        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered arrets_table" id="users_table">
                            <thead>
                                <th>Réference</th>
                                <th>Date de parution</th>
                                <th>Résumé</th>
                                <th>Analyses</th>
                                <th>Catégories</th>
                                <th>Options</th>
                            </thead>
                            <tbody>
                                <?php if(!empty($arrets)){ ?>
                                <?php foreach($arrets as $arret)
                                      {

                                        $arrets_categories = $arret->arrets_categories;
                                ?>
                                    <tr class="odd gradeX">
                                        <td class="center"><strong><?php echo $arret->reference; ?></strong></td>
                                        <td class="center"><?php echo $arret->pub_date->format('d/m/Y'); ?></td>
                                        <td class="center"><?php echo $custom->limit_words($arret->abstract,20); ?></td>
                                        <td class="center">
                                            <?php if( isset($analyses[$arret->id]) ) {?>
                                            <ul class="fa-ul">
                                            <?php
                                                foreach($analyses[$arret->id] as $arrets_analyse)
                                                {
                                                    echo '<li><a href="'.url('admin/analyses/'.$arrets_analyse->analyse_id).'" class="">
                                                                <i class="fa-li fa fa-bookmark"></i>
                                                                '.$arrets_analyse->authors.' | '.$custom->getCreatedAtAttribute($arrets_analyse->pub_date).'</a></li>';
                                                }
                                            ?>
                                            </ul>
                                            <?php } ?>
                                        </td>
                                        <td>
                                            <?php if( !$arrets_categories->isEmpty() ) { ?>
                                            <div class="list-group">
                                                <?php
                                                    foreach($arrets_categories as $arrets_categorie)
                                                    {
                                                        echo '<p class="list-group-item">'.$arrets_categorie->title.'</p>';
                                                    }
                                                ?>
                                            </div>
                                            <?php } ?>
                                        </td>
                                        <td><a class="btn btn-primary btn-sm edit_btn" href="{{ url('admin/arrets/'.$arret->id) }}">éditer</a></td>
                                    </tr>
                                <?php }} ?>
                            </tbody>
                        </table>

                    </div><!-- end body panel -->
                </div><!-- end panel -->

            </div><!-- end col -->
        </div><!-- end row -->

    </div><!-- end container  -->

@stop
