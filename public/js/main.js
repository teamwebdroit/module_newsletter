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

        /**
         * Redactor wysiwyg editor configuration
         */
        redactorOptions.minHeight = 200;
        redactorOptions.formattingTags = ['p', 'h2', 'h3','h4'];
}).config(['flowFactoryProvider', function (flowFactoryProvider) {

        /**
         * Flow image upload configuration
         */
        flowFactoryProvider.defaults = {
            target: 'upload',
            testChunks:false,
            singleFile: true,
            permanentErrors: [404, 500, 501],
            simultaneousUploads: 4
        };
}]);

/**
 * Retrive all newsletter types blocs for build
 */

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

/**
 * Retrive all arrets blocs for bloc arret
 */

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

/**
 * Build controller, controls all bloc for building the newsletter
 */
App.controller('BuildController', ['$scope','$http','Blocs',function($scope,$http,Blocs){

    /* assign empty values for blocs */
    this.blocs  = [];

    /* capture this (the controller scope ) as self */
    var self    = this;

    /* function for refreshing the asynchronus retrival of blocs */
    this.refresh = function() {
        Blocs.query()
            .then(function (data) {
                //console.log(data.blocs);
                self.blocs = data.blocs;
            })
    }

    this.refresh();

}]);

/**
 * Form controller, controls the form for creating new content blocs
 */
App.controller("FormController", function($scope,$http){

    $scope.addContent = function(form,type) {

        /* gather all date to send to the server */
        var image =  $('.uploadImage').val();
        var data  =  { titre : form.titre.$modelValue , image : image , contenu: form.contenu.$modelValue, type: type };

        /* Send data */
        var all = $.param( data);

            $http({
                method : 'POST',
                url : 'process',
                data : all, // pass in data as strings
                headers: {'Content-Type': 'application/x-www-form-urlencoded'} // set the headers so angular passing info as form data (not request payload)
            })
            .success(function(data)
            {
                // TODO implement success and fail result processing form
                if (!data.success) {
                    console.log(data);
                }
                else {
                    alert('probleme avec le process form');
                }
            });
    };
});

/**
 * Drag and Drop controller, catch the bloc who has been dropped
 */
App.controller('DropController', ['$scope','Blocs',function($scope,Blocs){

    /* assign empty values for blocs */
    this.blocDrop = 0;
    this.blocs    = [];

    /* capture this (the controller scope ) as self */
    var self = this;

    /* function for refreshing the asynchronus retrival of blocs */
    $scope.refresh = function() {
        Blocs.query()
            .then(function (data) {
                //console.log(data.blocs);
                self.blocs = data.blocs;
            })
    }

    $scope.refresh();

    /* Get the dropped blocs id and set it */
    $scope.dropped = function(event, ui){
        var template = ui.draggable.attr("id");
        $scope.setBloc(template);
    };

    $scope.setBloc = function(bloc){
        $scope.blocDrop = bloc;
    };

    /* Test if the bloc is the one selected to create the correct template view */
    $scope.isBloc = function(bloc){
        return $scope.blocDrop === bloc;
    };

}]);

/**
 * Select arret controller, select an arret and display's it
 */
App.controller('SelectController', ['$scope','Arrets',function($scope,Arrets){

    /* assign empty values for arrets */
    this.arrets = [];
    this.arret  = false;

    /* capture this (the controller scope ) as self */
    var self = this;

    /* function for refreshing the asynchronus retrival of blocs */
    this.refresh = function() {
        Arrets.query()
            .then(function (data) {
                self.arrets = data;
            });
    }

    this.refresh();

    /* When one arret is selected in the dropdown */
    this.changed = function(){

        /* hide arret */
        self.arret = false;
        self.categories = false;
        self.date  = new Date();

        /* Get the id of arret */
        var id = $scope.selected.id

        /* Get the selected arret infos */
        Arrets.simple(id)
            .then(function (data) {
                self.arret = data;
                self.categories = data.arrets_categories;

                //get substring
                var jsonObject = self.arret.pub_date.substr(0,10);
                var newdate    = new Date(jsonObject);
                self.date      = self.convertDate(newdate)

                console.log(data);
            });

    };

    this.convertDate = function(date){

        var months  = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
        var newdate = date.getDate();
        if (newdate < 10)
        {
            newdate = "0" + newdate;
        }
        var output = newdate + " " + months[date.getMonth()] + " " + date.getFullYear();
        return output;
    }



}]);

/**
 * Build directive, display all types of content
 */
App.directive("buidingBlocs", function() {
    return {
        restrict: "EA",
        scope:true,
        templateUrl: "building-blocs"
    };
});

/**
 * Build directive, all blocs of content
 */
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


/**
 * Array for test
 */
var bloces = [
    { titre : 'Image Left and Text',  image : 'imageLeftText.svg', type: 'imageLeftText'  },
    { titre : 'Image Right and Text', image : 'imageRightText.svg', type: 'imageRightText' },
    { titre : 'Image and Text', image : 'imageText.svg', type: 'imageText' },
    { titre : 'Image', image : 'image.svg' , type: 'image'},
    { titre : 'Texte', image : 'text.svg' , type: 'text'}
];
