(function ($, Drupal) {

  Drupal.behaviors.angular = {
    attach: function(context, settings) {
      var dmci = angular.module('dmci', []);

      dmci.controller('newsPageController', function($scope, PollerNews) {
        // Response from service.
        $scope.newsPage = PollerNews.data;
      });

      dmci.controller('newsConsUpdateController', function($scope, PollerConsUpdate) {
        // Response from service.
        $scope.newsCons = PollerConsUpdate.data;
      });

      dmci.controller('newsLatestNewsController', function($scope, PollerLatestNews) {
        // Response from service.
        $scope.newsLatestNews = PollerLatestNews.data;
      });

      dmci.controller('userController', function($scope, PollerUser) {
        // Response from service.
        $scope.user = PollerUser.data;
      });

      dmci.controller('reservationListController', function($scope, $http, PollerReservationList) {
        // Response from service.
        $scope.reservationList = PollerReservationList.data;

        var sid = {};
        $scope.setSid = function($sid, $unit, $reserved, $name, $development) {
          sid.sid = $sid;
          sid.unit = $unit;
          sid.reserved = $reserved;
          sid.name = $name;
          sid.development = $development;
        }

        $scope.closeModal = function() {
          $http.defaults.headers.post["Content-Type"] = "application/x-www-form-urlencoded";
          $http.post('/update-reservation', { status: $scope.status, sid: sid.sid, unit: sid.unit, reserved: sid.reserved, name: sid.name, development: sid.development})
          .success(function(data, status, headers, config) { console.log(data) })
        }
      });

      dmci.controller('availabilityController', function($scope, PollerAvailability) {
        // Response from availability.
        $scope.availability = PollerAvailability.data;
      });

      dmci.controller('updatesController', function($scope, PollerUpdates) {
        // Response from updates.
        $scope.updates = PollerUpdates.data;
      });

      dmci.controller('contactsController', function($scope, PollerContacts) {
        // Response from contacts.
        console.log($scope.contacts = PollerContacts.data);
      });

      dmci.controller('propertyController', function($scope, PollerProperty) {
        // Response from property.
        $scope.property = PollerProperty.data;
      });

      // Run the news Poller.
      dmci.run(function(PollerNews) {});

      // Run the construction updates Poller.
      dmci.run(function(PollerConsUpdate) {});

      // Run the latest news Poller.
      dmci.run(function(PollerLatestNews) {});

      // Run the user Poller.
      dmci.run(function(PollerUser) {});

      // Run the reservation Poller.
      dmci.run(function(PollerReservationList) {});

      // Run the availability Poller.
      dmci.run(function(PollerAvailability) {});

      // Run the updates Poller.
      dmci.run(function(PollerUpdates) {});

      // Run the contacts Poller.
      dmci.run(function(PollerContacts) {});

      // Run the contacts Poller.
      dmci.run(function(PollerProperty) {});

      // Create a poller for news that will create a request every 1000 ms.
      dmci.factory('PollerNews', function($http, $timeout) {
        var data = {
          response: {},
          calls: 0
        };

        var pollerNews = function() {
          $http.get('/data/page/news').then(function(r) {
            data.response = r.data;
            data.calls++;
            $timeout(pollerNews, 1000);
          });
        };
        pollerNews();

        return {
          data: data
        };
      });

      // Create a poller for construction update that will create a request every 1000 ms.
      dmci.factory('PollerConsUpdate', function($http, $timeout) {
        var data = {
          response: {},
          calls: 0
        };

        var pollerConsUpdate = function() {
          $http.get('/data/block/construction-updates').then(function(r) {
            data.response = r.data;
            data.calls++;
            $timeout(pollerConsUpdate, 1000);
          });
        };
        pollerConsUpdate();

        return {
          data: data
        };
      });

      // Create a poller for latest news that will create a request every 1000 ms.
      dmci.factory('PollerLatestNews', function($http, $timeout) {
        var data = {
          response: {},
          calls: 0
        };

        var pollerLatestNews = function() {
          $http.get('/data/news/latest-news').then(function(r) {
            data.response = r.data;
            data.calls++;
            $timeout(pollerLatestNews, 1000);
          });
        };
        pollerLatestNews();

        return {
          data: data
        };
      });

      // Create a poller for user that will create a request every 1000 ms.
      dmci.factory('PollerUser', function($http, $timeout) {
        var data = {
          response: {},
          calls: 0
        };

        var pollerUser = function() {
          $http.get('/data/user').then(function(r) {
            data.response = r.data;
            data.calls++;
            $timeout(pollerUser, 1000);
          });
        };
        pollerUser();

        return {
          data: data
        };
      });

      // Create a poller for reservation that will create a request every 1000 ms.
      dmci.factory('PollerReservationList', function($http, $timeout) {
        var data = {
          response: {},
          calls: 0
        };

        var pollerReservationList = function() {
          $http.get('/data/reservation2').then(function(r) {
            data.response = r.data;
            data.calls++;
            $timeout(pollerReservationList, 1000);
          });
        };
        pollerReservationList();

        return {
          data: data
        };
      });

      // Create a poller for availability that will create a request every 1000 ms.
      dmci.factory('PollerAvailability', function($http, $timeout) {
        var data = {
          response: {},
          calls: 0
        };

        var pollerAvailability = function() {
          $http.get('/data/availability').then(function(r) {
            data.response = r.data;
            data.calls++;
            $timeout(pollerAvailability, 1000)
          });
        };
        pollerAvailability();

        return {
          data: data
        };
      })

      // Create a poller for updates that will create a request every 1000 ms.
      dmci.factory('PollerUpdates', function($http, $timeout) {
        var data = {
          response: {},
          calls: 0
        };

        var pollerUpdates = function() {
          $http.get('/data/get-updates').then(function(r) {
            data.response = r.data;
            data.calls++;
            $timeout(pollerUpdates, 1000)
          });
        };
        pollerUpdates();

        return {
          data: data
        };
      })

      // Create a poller for contacts that will create a request every 1000 ms.
      dmci.factory('PollerContacts', function($http, $timeout) {
        var data = {
          response: {},
          calls: 0
        };

        var pollerContacts = function() {
          $http.get('/data/contact2/all').then(function(r) {
            data.response = r.data;
            data.calls++;
            $timeout(pollerContacts, 1000)
          });
        };
        pollerContacts();

        return {
          data: data
        };
      })

      // Create a poller for property that will create a request every 1000 ms.
      dmci.factory('PollerProperty', function($http, $timeout) {
        var data = {
          response: {},
          calls: 0
        };

        var pollerProperty = function() {
          $http.get('/data/project-list').then(function(r) {
            data.response = r.data;
            data.calls++;
            $timeout(pollerProperty, 1000)
          });
        };
        pollerProperty();

        return {
          data: data
        };
      })
    }
  };
})(jQuery, Drupal);
