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
 * Retrive all arrets blocs for bloc arret
 */
App.factory('Contents', ['$http', '$q', function($http, $q) {
    return {
        query: function(id) {
            var deferred = $q.defer();
            $http.get('/prepareCampagne/'+id, { cache: true }).success(function(data) {
                deferred.resolve(data);
            }).error(function(data) {
                deferred.reject(data);
            });
            return deferred.promise;
        },
        simple: function(id) {
            var deferred = $q.defer();
            $http.get('/contents/'+ id).success(function(data) {
                deferred.resolve(data);
            }).error(function(data) {
                deferred.reject(data);
            });
            return deferred.promise;
        }
    };
}]);

