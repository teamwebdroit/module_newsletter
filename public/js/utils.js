$(function() {

    $('body').on('click','.deleteAction',function(event){

        var $this   = $(this);
        var action  = $this.data('action');
        var message = $this.data('message');

        var answer = confirm('Voulez-vous vraiment supprimer : '+ action +' ? ' + message);

        if (answer){
            return true;
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

                if(data)
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


});