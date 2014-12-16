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
        var answer = confirm('Voulez-vous vraiment supprimer : '+ action +' ?');

        if (answer)
        {
            $.ajax({
                url     : 'remove',
                data    : { id: id },
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

        $.ajax({
            url     : 'admin/categorie/arretsExists',
            data    : { id: id },
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
        $('#modalImage').empty();

        $.ajax({
            url     : 'admin/file/imageIsUsed',
            data    : { file: file },
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


/*    $.datepicker.regional['fr-CH'] = {
        closeText: 'Fermer',
        prevText: '&#x3c;Préc',
        nextText: 'Suiv&#x3e;',
        currentText: 'Courant',
        dateFormat: "yy-mm-dd",
        monthNames: ['Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Août','Septembre','Octobre','Novembre','Décembre'],
        monthNamesShort: ['Jan','Fév','Mar','Avr','Mai','Jun','Jul','Aoû','Sep','Oct','Nov','Déc'],
        dayNames: ['Dimanche','Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi'],
        dayNamesShort: ['Dim','Lun','Mar','Mer','Jeu','Ven','Sam'],
        dayNamesMin: ['Di','Lu','Ma','Me','Je','Ve','Sa'],
        weekHeader: 'Sm',
        firstDay: 1,
        isRTL: false,
        showMonthAfterYear: false,
        yearSuffix: ''
    };

    $.datepicker.setDefaults($.datepicker.regional['fr-CH']);

    $( ".datePicker" ).datepicker();*/

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


    $('body').on('click','.editContent',function(event){

        var $this  = $(this);
        var id     = $this.data('id');

        $('.edit_content_form').hide();
        $('#edit_'+id).show();

    });

    $('body').on('click','.cancelEdit',function(event){
        $('.edit_content_form').hide();
    });

    $('body').on('click','.cancelCreate',function(event){
        $('.create_bloc').hide();
    });

    $('body').on('click','.blocEdit',function(event){

        var $this  = $(this);
        var id     = $this.attr('rel');
    console.log(id);
        $('.create_bloc').hide();
        $('#create_'+id).show();

    });

});
