(function ($, Drupal) {

  Drupal.behaviors.refresh = {
    attach: function(context, settings) {
      var app = angular.module('app', []);

      app.controller('appController', function($scope, $http, Poller) {
        $http.get("/nodes/json").success(function(response) {
          $scope.data = response;
          // Pagination settings.
          $scope.currentPage = 0;
          $scope.pageSize = 2;
          $scope.numberOfPages=function() {
            return Math.ceil($scope.data.length/$scope.pageSize);
          }
        });
        // Response from service.
        //$scope.data = Poller.data ;



      });

      // StartFrom filter.
      app.filter('firstPage', function() {
        return function(input, start) {
          start = +start;
          return input.slice(start);
        }
      });

      // Run the Poller.
      app.run(function(Poller) {});
      // Create a poller that will create a request to
      // the endpoint every 1000 ms.
      app.factory('Poller', function($http, $timeout) {
        var data = {
          response: {},
          calls: 0
        };

        var poller = function() {
          $http.get('/nodes/json').then(function(r) {
            data.response = r.data;
            data.calls++;
            $timeout(poller, 1000);
          });
        };
        poller();

        return {
          data: data
        };
      });
    }
  };
})(jQuery, Drupal);
