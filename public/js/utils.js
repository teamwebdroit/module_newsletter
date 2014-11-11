$(function() {

    $('#content').redactor({
        minHeight: 150
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

    $('body').on('click','.deleteCategorie',function(event){

        var $this      = $(this);
        var id         = $this.data('id');
        $('#modalCategorie').empty();

        $.ajax({
            url     : 'categorie/arretsExists',
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

                $('#deleteCategorie').modal();
            }
        });
    });

    $('#deleteConfirm').click(function() {
        $('#deleteCategorieForm').submit();
    });

    $.datepicker.regional['fr-CH'] = {
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

    $( ".datePicker" ).datepicker();

});