var App = angular.module('newsletter', ["angular-redactor","flow","ngSanitize"] , function($interpolateProvider)
{
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');

}).config(function(redactorOptions) {
        /* Redactor wysiwyg editor configuration */
        redactorOptions.minHeight      = 120;
        redactorOptions.formattingTags = ['p', 'h2', 'h3','h4'];
        redactorOptions.fileUpload     = 'uploadRedactor';
        redactorOptions.lang           = 'fr';
        redactorOptions.buttons        = ['html','|','formatting','bold','italic','|','unorderedlist','orderedlist','outdent','indent','|','image','file','link','alignment'];
}).config(['flowFactoryProvider', function (flowFactoryProvider) {
        /* Flow image upload configuration */
        flowFactoryProvider.defaults = {
            target: 'uploadJS',
            testChunks:false,
            singleFile: true,
            permanentErrors: [404, 500, 501],
            simultaneousUploads: 4
        };
}]).service('myService',  function ($rootScope) {
    var blocDrop = 0;
    return {
        getBloc : function() {
            return blocDrop;
        },
        setBloc : function(bloc) {
            $('.edit_content_form').hide();
            blocDrop = bloc;
        }
    };
});

/**
 * Retrive all arrets blocs for bloc arret
 */
App.factory('Arrets', ['$http', '$q', function($http, $q) {
    return {
        query: function() {
            var deferred = $q.defer();
            $http.get('/arrets', { cache: true }).success(function(data) {
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
 * Form controller, controls the form for creating new content blocs
 */
App.controller("EditController",['$scope','$http','myService', function($scope,$http,myService){

    $scope.editable = 0;

    this.onedit = function(id){
        return id == $scope.editable;
    };

    this.close = function(){
        $('.edit_content_form').hide();
    };

    this.editContent = function(idItem){

        var w = $( document ).width();
        w = w - 890;

        myService.setBloc(0);

        $scope.editable = idItem;

        $('.edit_content_form').hide();

        var content = $('#bloc_rang_'+idItem);
        content.find('.edit_content_form').css("width",w).show();
        $( "#sortable" ).sortable( "disable" );

    };

}]);
/**
 * Select arret controller, select an arret and display's it
 */
App.controller('SelectController', ['$scope','$http','Arrets','myService',function($scope,$http,Arrets,myService){

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

    if(self.arrets.length == 0){
        this.refresh();
    }

    this.close = function(){
        myService.setBloc(0);
        $('.edit_content_form').hide();
    };

    /* When one arret is selected in the dropdown */
    this.changed = function(){

        /* hide arret */
        self.arret      = false;
        self.categories = false;
        self.date       = new Date();

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
    };

}]);

App.directive('bindContent', function() {
    return {
        require: 'ngModel',
        link: function ($scope, $element, $attrs, ngModelCtrl) {
            ngModelCtrl.$setViewValue($element.text());
            ngModelCtrl.$setViewValue($element.val());
        }
    }
});
