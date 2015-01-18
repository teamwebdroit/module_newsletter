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
        },
        convertArret: function(data, models){

            angular.forEach( data , function(value, key){
                models.lists.A.push({
                    reference    : value.reference,
                    isSelected   : false,
                    itemId       : value.id
                });
            });

            return models;
        },
        convertCategories: function(data, models){

            angular.forEach( data , function(value, key){
                models.lists.A.push({
                    title      : value.title,
                    isSelected : false,
                    itemId     : value.id
                });
            });

            return models;
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

App.controller("MultiSelectionController",['$scope',"Categories","Arrets","myService", function($scope,Categories,Arrets,myService){

    /* capture this (the controller scope ) as self */
    var self = this;

    this.items = [];
    this.type  = '';

    self.models = {
        selected: null,
        lists: {"A": [], "B": []}
    };

    /* function for refreshing the asynchronus retrival of blocs */
    this.refresh = function() {

        if( $scope.typeItem == 'categories'){

            Categories.query()
                .then(function (data) {

                    self.items  = data;
                    self.models = myService.convertCategories(self.items, self.models);
                });
        }

        if( $scope.typeItem == 'arrets'){

            Arrets.query()
                .then(function (data) {

                    self.items  = data;
                    self.models = myService.convertArret(self.items, self.models);

                });
        }

    }

    if(self.items.length == 0){
        $scope.$watch("typeItem", function(){
            self.refresh();
        });
    }

    this.dropped = function(item){

        angular.forEach(self.models.lists.B, function(value, key){
            value.isSelected = true;
        });
        angular.forEach(self.models.lists.A, function(value, key){
            value.isSelected = false;
        });

    };

}]);

