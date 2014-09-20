var url  = location.protocol + "//" + location.host+"/";

(function ($) {

    var url  = location.protocol + "//" + location.host+"/";

    $('#content').redactor({
        minHeight: 300
    });
/*
    $( ".bloc" ).draggable();

    $( "#build" ).droppable({
        drop: function( event, ui ) {
            $( this )
                .addClass( "ui-state-highlight" )
                .find( "p" )
                .html( "Dropped!" );
        }
    });*/

})(jQuery);

var App = angular.module('newsletter', ["ngDragDrop","angular-redactor","flow","ngSanitize"] , function()
{

    // Change opening and closing tags for working with blade
}).config(function(redactorOptions) {
        redactorOptions.minHeight = 200;
        redactorOptions.formattingTags = ['p', 'h2', 'h3','h4'];
}).config(['flowFactoryProvider', function (flowFactoryProvider) {
        flowFactoryProvider.defaults = {
            target: 'upload',
            testChunks:false,
            singleFile: true,
            permanentErrors: [404, 500, 501],
            maxChunkRetries: 1,
            chunkRetryInterval: 5000,
            simultaneousUploads: 4
        };
}]);

App.controller('BuildController', ['$scope',function($scope){

    this.blocs = blocs;

}]);

App.controller('DropController', ['$scope',function($scope){

    $scope.blocs     = blocs;
    $scope.blocDrop  = 0;

    $scope.dropped = function(event, ui){

        var index = ui.draggable.attr("id");
        index = parseInt(index) + 1;
        //var bloc = blocs[index];

        $scope.setBloc(index);
    };

    $scope.setBloc = function(bloc){

        $scope.blocDrop = bloc;

        console.log($scope.blocDrop);
    };

    $scope.isBloc = function(bloc){

        return $scope.blocDrop === bloc;

    };

}]);

App.directive("buidingBlocs", function() {
    return {
        restrict: "EA",
        scope:true,
        templateUrl: "building-blocs"
    };
});


App.directive("imageLeftText", function() {
    return {
        restrict: "EA",
        scope:{
            ngModel: '='
        },
        templateUrl: "image-left-text"
    };
});

App.directive("imageRightText", function() {
    return {
        restrict: "EA",
        scope:{
            ngModel: '='
        },
        templateUrl: "image-right-text"
    };
});

App.directive("imageText", function() {
    return {
        restrict: "EA",
        scope:{
            ngModel: '='
        },
        templateUrl: "image-text"
    };
});

App.directive("imageAlone", function() {
    return {
        restrict: "EA",
        scope:{
            ngModel: '='
        },
        templateUrl: "image"
    };
});

var blocs = [
    { title : 'Image Left and Text',  image : 'imageLeftText.svg', type: 'imageLeftText'  },
    { title : 'Image Right and Text', image : 'imageRightText.svg', type: 'imageRightText' },
    { title : 'Image and Text', image : 'imageText.svg', type: 'imageText' },
    { title : 'Image', image : 'image.svg' , type: 'image'}
];
