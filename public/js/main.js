(function ($) {

    var url  = location.protocol + "//" + location.host+"/";

    $('#content').redactor({
        minHeight: 300
    });

    $( ".builBloc" ).draggable();

    $( "#build" ).droppable({
        drop: function( event, ui ) {
            $( this )
                .addClass( "ui-state-highlight" )
                .find( "p" )
                .html( "Dropped!" );
        }
    });

})(jQuery);


angular.module('newsletter', [] , function($interpolateProvider)
{
    $interpolateProvider.startSymbol('<%');
    $interpolateProvider.endSymbol('%>');
    // Change opening and closing tags for working with blade

}).controller('DragDropController', ['$scope', function($scope)
{

    $scope.blocs = [
        { title : 'Image Left and Text',  image : 'imageLeftText.svg'  },
        { title : 'Image Right and Text', image : 'imageRightText.svg' },
        { title : 'Image and Text', image : 'imageText.svg' },
        { title : 'Image', image : 'image.svg' }
    ];

}]);


