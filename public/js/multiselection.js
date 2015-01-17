var App = angular.module('selection', ["dndLists"] , function($interpolateProvider)
{
    $interpolateProvider.startSymbol('{[{').endSymbol('}]}');

}).service('myService',  function ($rootScope) {
    return {
        convertDateArret: function(date){
            var jsonObject  = date.substr(0,10);
            var convertdate = new Date(jsonObject);

            var months  = ["janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"];
            var newdate = convertdate.getDate();
            if (newdate < 10)
            {
                newdate = "0" + newdate;
            }
            var output = newdate + " " + months[convertdate.getMonth()] + " " + convertdate.getFullYear();
            return output;
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
        }
    };
}]);

/**
 * Retrive all arrets blocs for bloc arret
 */
App.factory('Categories', ['$http', '$q', function($http, $q) {
    return {
        query: function() {
            var deferred = $q.defer();
            $http.get('/categories').success(function(data) {
                deferred.resolve(data);
            }).error(function(data) {
                deferred.reject(data);
            });
            return deferred.promise;
        }
    };
}]);

App.controller("MultiSelectionController",['$scope',"Categories","myService", function($scope,Categories,myService){

    this.categories = [];
    /* capture this (the controller scope ) as self */
    var self = this;

    self.categoriemodels = {
        selected: null,
        lists: {"A": [], "B": []}
    };

    /* function for refreshing the asynchronus retrival of blocs */
    this.refresh = function() {

        Categories.query()
            .then(function (data) {

                self.categories = data;

                angular.forEach( self.categories , function(value, key){
                    self.categoriemodels.lists.A.push({
                        title      : value.title,
                        isSelected : false,
                        itemId     : value.id
                    });
                });

            });
    }

    if(self.categories.length == 0){
        this.refresh();
    }

    this.dropped = function(item){

        angular.forEach(self.categoriemodels.lists.B, function(value, key){
            value.isSelected = true;
        });
        angular.forEach(self.categoriemodels.lists.A, function(value, key){
            value.isSelected = false;
        });
    };

}]);


App.controller("ArretSelectionController",['$scope',"Arrets","myService", function($scope,Arrets,myService){

    this.arrets = [];
    /* capture this (the controller scope ) as self */
    var self = this;

    self.arretmodels = {
        selected: null,
        lists: {"A": [], "B": []}
    };

    /* function for refreshing the asynchronus retrival of blocs */
    this.refresh = function() {
        Arrets.query()
            .then(function (data) {

                self.arrets = data;

                angular.forEach( self.arrets , function(value, key){
                    self.arretmodels.lists.A.push({
                        reference    : value.reference,
                        isSelected   : false,
                        itemId       : value.id
                    });
                });

                console.log(self.arretmodels);

            });
    }

    if(self.arrets.length == 0){
        this.refresh();
    }

    self.dropped = function(item){

        angular.forEach(self.arretmodels.lists.B, function(value, key){
            value.isSelected = true;
        });
        angular.forEach(self.arretmodels.lists.A, function(value, key){
            value.isSelected = false;
        });
    };

}]);
