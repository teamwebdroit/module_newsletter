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

App.controller("FormController", function($scope,$http){


    $scope.addContent = function(form,type) {

        var image =  $('.uploadImage').val();
        var data  =  { titre : form.titre.$modelValue , image : image , contenu: form.contenu.$modelValue, type: type };
        console.log(data);

        var all = $.param( data);

            $http({
                method : 'POST',
                url : 'process',
                data : all, // pass in data as strings
                headers: {'Content-Type': 'application/x-www-form-urlencoded'} // set the headers so angular passing info as form data (not request payload)
            })
            .success(function(data) {

                console.log(data);

                if (!data.success) {
                    // if not successful, bind errors to error variables
                }
                else {
                // if successful, bind success message to message
                }
            });

    };

});

App.controller('DropController', ['$scope',function($scope){

    $scope.blocs     = blocs;
    $scope.blocDrop  = 0;

    $scope.dropped = function(event, ui){

        var index = ui.draggable.attr("id");
        index     = parseInt(index) + 1;
        $scope.setBloc(index);
    };

    $scope.setBloc = function(bloc){

        $scope.blocDrop = bloc;

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
