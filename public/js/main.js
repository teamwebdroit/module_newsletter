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

var App = angular.module('newsletter', ["ngDragDrop","ngResource","angular-redactor","flow","ngSanitize"] , function()
{
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

App.factory('Blocs', ['$http', '$q', function($http, $q) {
    return {
        query: function() {
            var deferred = $q.defer();
            $http.get('/building')
                .success(function(data) {
                    deferred.resolve(data);
                })
                .error(function(data) {
                    deferred.reject(data);
                });
            return deferred.promise;
        }
    };
}]);

App.factory('Arrets', ['$http', '$q', function($http, $q) {
    return {
        query: function() {
            var deferred = $q.defer();
            $http.get('/arrets').success(function(data) {
                    deferred.resolve(data);
                }).error(function(data) {
                    deferred.reject(data);
                });
            return deferred.promise;
        },
        simple: function(id) {
            var deferred = $q.defer();
            $http.get('/arrets/'+ id).success(function(data) {
                deferred.resolve(data);
            }).error(function(data) {
                deferred.reject(data);
            });
            return deferred.promise;
        }
    };
}]);

App.controller('BuildController', ['$scope','$http','Blocs',function($scope,$http,Blocs){

    this.blocs  = [];
    var self    = this;

    this.refresh = function() {
        Blocs.query()
            .then(function (data) {
                //console.log(data.blocs);
                self.blocs = data.blocs;
            })
    }

    this.refresh();

}]);

App.controller("FormController", function($scope,$http){

    $scope.addContent = function(form,type) {

        var image =  $('.uploadImage').val();
        var data  =  { titre : form.titre.$modelValue , image : image , contenu: form.contenu.$modelValue, type: type };

        var all = $.param( data);

            $http({
                method : 'POST',
                url : 'process',
                data : all, // pass in data as strings
                headers: {'Content-Type': 'application/x-www-form-urlencoded'} // set the headers so angular passing info as form data (not request payload)
            })
            .success(function(data)
            {
                if (!data.success) {
                    console.log(data);
                }
                else {
                    alert('probleme avec le process form');
                }
            });
    };
});

App.controller('DropController', ['$scope','Blocs',function($scope,Blocs){

    $scope.blocDrop  = 0;

    this.blocs  = [];
    var self    = this;

    $scope.refresh = function() {
        Blocs.query()
            .then(function (data) {
                //console.log(data.blocs);
                self.blocs = data.blocs;
            })
    }

    $scope.refresh();

    $scope.dropped = function(event, ui){
        var template = ui.draggable.attr("id");
        $scope.setBloc(template);
    };

    $scope.setBloc = function(bloc){
        $scope.blocDrop = bloc;
    };

    $scope.isBloc = function(bloc){
        return $scope.blocDrop === bloc;
    };

}]);

App.controller('SelectController', ['$scope','Arrets',function($scope,Arrets){

    this.arrets  = [];
    var self     = this;

    this.refresh = function() {
        Arrets.query()
            .then(function (data) {
                self.arrets = data;
            });
    }

    this.refresh();

    this.changed = function(){
        console.log($scope.selected);

        var id = $scope.selected.id

        Arrets.simple(id)
            .then(function (data) {
                console.log(data);
            });

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

App.directive("textAlone", function() {
    return {
        restrict: "EA",
        scope:{
            ngModel: '='
        },
        templateUrl: "text"
    };
});

App.directive("arret", function() {
    return {
        restrict: "EA",
        templateUrl: "arret"
    };
});

var bloces = [
    { titre : 'Image Left and Text',  image : 'imageLeftText.svg', type: 'imageLeftText'  },
    { titre : 'Image Right and Text', image : 'imageRightText.svg', type: 'imageRightText' },
    { titre : 'Image and Text', image : 'imageText.svg', type: 'imageText' },
    { titre : 'Image', image : 'image.svg' , type: 'image'},
    { titre : 'Texte', image : 'text.svg' , type: 'text'}
];
