var BlocFactory = angular.module('BlocFactory', [] , function()
{
});

BlocFactory.factory('Blocs', ['$http', '$q', function($http, $q) {
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