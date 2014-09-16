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


var App = angular.module('newsletter', ['ngDragDrop'] , function($interpolateProvider)
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

        $scope.test = "hex ho";

        $scope.dropSuccessHandler = function($event,index,array){
            console.log(index);
        };

        $scope.onDrop = function($event,$data){
            console.log($data);
        };

    }]);

App.directive("myWidget", function() {

    var linkFunction = function(scope, element, attributes) {
        scope.text = attributes["myWidget"];
    };

    return {
        restrict: "A",
        scope: true,
        template: "<p>{{ text }}</p>",
        link: linkFunction
    };
});
