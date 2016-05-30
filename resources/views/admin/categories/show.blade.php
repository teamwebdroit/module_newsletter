@extends('layouts.admin')
@section('content')


<div class="row"><!-- row -->
    <div class="col-md-12"><!-- col -->
        <p><a class="btn btn-default" href="{{ url('admin/categorie') }}"><i class="fa fa-reply"></i> &nbsp;Retour à la liste</a></p>
    </div>
</div>
<!-- start row -->
<div class="row">

    @if ( !empty($categorie) )

    <div class="col-md-12">
        <div class="panel panel-midnightblue">

            <!-- form start -->
            {{ Form::model($categorie,array(
                'method'        => 'PUT',
                'id'            => 'categorie',
                'data-validate' => 'parsley',
                'files'         => true,
                'class'         => 'validate-form form-horizontal',
                'url'           => array('admin/categorie/'.$categorie->id)))
            }}

            <div class="panel-heading">
                <h4>&Eacute;diter {{ $categorie->title }}</h4>
            </div>
            <div class="panel-body event-info">

                <div class="form-group">
                    <label for="message" class="col-sm-3 control-label">Titre</label>
                    <div class="col-sm-3">
                        {{ Form::text('title', $categorie->title , array('class' => 'form-control') ) }}
                    </div>
                </div>

                @if(!empty($categorie->image ))
                <div class="form-group">
                    <label for="file" class="col-sm-3 control-label">Fichier</label>
                    <div class="col-sm-3">
                        <div class="list-group">
                            <div class="list-group-item text-center">
                                <a href="#"><img height="120" src="{{ asset('newsletter/pictos/'.$categorie->image) }}" alt="$categorie->title" /></a>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <div class="form-group">
                    <label for="file" class="col-sm-3 control-label">Changer l'image</label>
                    <div class="col-sm-7">
                        <div class="list-group">
                            <div class="list-group-item">
                                {{ Form::file('file') }}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Catégorie principale ?</label>
                    <div class="col-sm-7">
                        <label class="radio-inline">
                            <input type="radio" <?php echo (!$categorie->ismain ? 'checked' : ''); ?> name="ismain"  value="0"> Non
                        </label>
                        <label class="radio-inline">
                            <input type="radio" <?php echo ($categorie->ismain ? 'checked' : ''); ?> name="ismain" value="1"> Oui
                        </label>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Invisible sur site ?</label>
                    <div class="col-sm-7">
                        <label class="radio-inline">
                            <input type="radio" name="hideOnSite" <?php echo (!$categorie->hideOnSite ? 'checked' : ''); ?> value="0"> Non
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="hideOnSite" <?php echo ($categorie->hideOnSite ? 'checked' : ''); ?> value="1"> Oui
                        </label>
                    </div>
                </div>

            </div>
            <div class="panel-footer mini-footer ">
                {{ Form::hidden('id', $categorie->id )}}
                {{ Form::hidden('user_id', 1 )}}
                <div class="col-sm-3"></div>
                <div class="col-sm-6">
                    <button class="btn btn-primary" type="submit">Envoyer </button>
                </div>
            </div>
            {{ Form::close() }}
        </div>
    </div>

    @endif

</div>
<!-- end row -->

@stop