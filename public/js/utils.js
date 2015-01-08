$(function() {

    $('#content').redactor({
        minHeight  : 150,
        fileUpload : 'uploadRedactor',
        buttons    : ['html','|','formatting','bold','italic','|','unorderedlist','orderedlist','outdent','indent','|','image','file','link','alignment']
    });

    $('body').on('click','.deleteAction',function(event){

        var $this  = $(this);
        var action = $this.data('action');
        var answer = confirm('Voulez-vous vraiment supprimer : '+ action +' ?');

        if (answer){
            return true;
        }
        return false;
    });

    $('body').on('click','.deleteContentBloc',function(event){

        var $this  = $(this);
        var action = $this.data('action');
        var id     = $this.data('id');
        var _token = $("meta[name='token']").attr('content');
        var answer = confirm('Voulez-vous vraiment supprimer : '+ action +' ?');

        if (answer)
        {
            $.ajax({
                url     : 'remove',
                data    : { id: id , _token : _token},
                type    : "POST",
                success : function(data) {
                    if(data == 'ok')
                    {
                        console.log('ok remove');
                        $('#bloc_rang_'+id).remove();
                    }
                }
            });
        }

        return false;

    });

    /**
     *  Modal for delete a categorie as warning if arrets linked
     */
    $('body').on('click','.deleteCategorie',function(event){

        var $this      = $(this);
        var id         = $this.data('id');
        $('#modalCategorie').empty();
        var _token = $("meta[name='token']").attr('content');

        $.ajax({
            url     : 'admin/categorie/arretsExists',
            data    : { id: id, _token: _token },
            type    : "POST",
            success : function(data) {
                if(data.length > 0)
                {
                    var references = '<p class="text-danger"><strong>Attention!</strong>Les arrêts suivant sont liés à cette catégorie</p><ul>';
                    $.each(data, function( index, value ) {
                        var item = '<li>'+ value +'</li>';
                        references = references.concat(item);
                    });
                    references.concat('</ul>');

                    $('#modalCategorie').append(references);
                }
                $('#deleteConfirm').data('categorie' , id);
                $('#deleteCategorie').modal();
            }
        });
    });

    $('#deleteConfirm').click(function() {
        var cat = $(this).data('categorie');
        console.log(cat);
        $('#deleteCategorieForm_' + cat).submit();
    });

    /**
     *  Modal for delete a image as warning if arrets or newsletter content linked
     */
    $('body').on('click','.deleteImage',function(event){

        var $this = $(this);
        var file  = $this.data('file');
        var index = $this.data('index');
        var _token = $("meta[name='token']").attr('content');

        $('#modalImage').empty();

        $.ajax({
            url     : 'admin/file/imageIsUsed',
            data    : { file: file, _token: _token  },
            type    : "POST",
            success : function(data) {

                var isUsed = 0;
                var warning    = '';
                var references = '<ul>';
                var elements   = { category: 'Categorie', newsletter: 'Newsletter', arret: 'Arrêts' };

                $.each(data, function( index, value ) {

                    console.log(index);
                     if(value.length > 0)
                     {
                        isUsed = 1;
                        references = references.concat('<li>'+ elements[index] +'</li>');
                     }

                    warning = ( isUsed ? '<p class="text-danger"><strong>Attention!</strong>L\'image est lié aux éléments suivant</p>' : '' );

                });

                references.concat('</ul>');
                $('#modalImage').append(warning);
                $('#modalImage').append(references);

                $('#deleteImageConfirm').data('index' , index);
                $('#deleteImage').modal();
            }
        });
    });

    $('#deleteImageConfirm').click(function() {
        var index = $(this).data('index');
        $('#deleteImageForm_'+index).submit();
    });

    $.fn.datepicker.dates['fr'] = {
        days: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
        daysShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
        daysMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
        months: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
        monthsShort: ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'],
        today: "Aujourd'hui",
        clear: "Clear"
    };

    $('.datePicker').datepicker({
        format: 'yyyy-mm-dd',
        language: 'fr'
    });

    /* popup for files images */

    $('body').on('click','.mix a',function(e){
        e.preventDefault();
        $('.modal-title').empty();
        $('.modal-body').empty();

        var title = $(this).attr('rel');
        $('.modal-title').html(title);

        var img = '<img class="img-responsive" style="max-height: 400px;" src=' +$(this).attr("href")+ '></img>';
        $(img).appendTo('.modal-body');

        $('#gallarymodal').modal({show:true});
    });

    /**
     *  Create and edit newsletter blocs
     */

    $('body').on('click','.editContent',function(event){

        var $this  = $(this);
        var id     = $this.data('id');

        $('.create_bloc').hide();
        $('.edit_content_form').hide();
        $('#edit_'+id).show();
        $( "#sortable" ).sortable( "disable" );
    });

    $('body').on('click','.cancelEdit',function(event){
        $('.edit_content_form').hide();
        $( "#sortable" ).sortable( "enable" );
    });

    $('body').on('click','.cancelCreate',function(event){
        $('.create_bloc').hide();
        $( "#sortable" ).sortable( "enable" );
    });

    $('body').on('click','.blocEdit',function(event){
        var $this  = $(this);
        var id     = $this.attr('rel');
        var w = $( document ).width();
        w = w - 890;

        $('.create_bloc').hide();
        $('.edit_content_form').hide();

        var content = $('#create_'+id);
        content.find('.create_content_form').css("width",w);

        $('#create_'+id).show();
        $( "#sortable" ).sortable( "disable" );
    });

    $('#bootbox-demo-3').click(function(){

        var campagneId = $(this).data('campagne');
        var sujet      = '';

        /**
         * Get campagne infos
        */
        $.get('admin/campagne/simple/' + campagneId , function( campagne ) {
            sujet = campagne.sujet;
            console.log(sujet);
        }) .always(function() {

            /**
             * Modal
             */
            bootbox.dialog({
                message: "Etes-vous sûr de vouloir envoyer la campagne : <strong>" + sujet + "</strong>?",
                title: "Envoyer la campagne",
                buttons: {
                    success: {
                        label: "Oui!",
                        className: "btn-success",
                        callback: function() {
                            $("#sendCampagneForm").submit();
                        }
                    },
                    main: {
                        label: "Annuler",
                        className: "btn-default"
                    }
                }
            });

        });

    });

});
