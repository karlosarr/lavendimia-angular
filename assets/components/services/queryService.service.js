(function() {
  "use strict";
  angular
    .module("HMZAdminApp")
    .factory("QueryService", ["$http", "$q", "site.config", QueryService]);

  //////////////// factory

  function QueryService($http, $q, SiteConfig) {
    var service = {
      queryDashboardData: loadDashboardData,
      querySystemData: loadSystemData,
      queryCommission: loadCommission,
      queryClient: loadClient,
      queryItem: loadItem,
      querySaveSale: loadSaveSale,
      querySale: loadSale,
      queryIdSale: loadIdSale
    };

    return service;

    //////////////// definition

    function loadDashboardData(params, data) {
      return query("GET", SiteConfig.DASHBOARD_API_URL, params, data);
    }

    function loadSystemData(params, data) {
      return query("GET", SiteConfig.SYSTEMHEALTH_API_URL, params, data);
    }

    function loadCommission(params, data) {
      return query("GET", SiteConfig.CONFIGURATION_API_URL, params, data);
    }

    function loadClient(params, data) {
      return query("GET", SiteConfig.CLIENT_API_URL, params, data);
    }

    function loadItem(params, data) {
      return query("GET", SiteConfig.ITEM_API_URL, params, data);
    }

    function loadSaveSale(params, data) {
      return query("POST", SiteConfig.SAVE_SALES_API_URL, params, data);
    }

    function loadSale(params, data) {
      return query("GET", SiteConfig.SALES_API_URL, params, data);
    }

    function loadIdSale(params, data) {
      return query("GET", SiteConfig.SALES_ID_API_URL, params, data);
    }

    function query(method, url, params, data) {
      var deferred = $q.defer();

      $http({
        method: method,
        url: url,
        params: params,
        data: data
      }).then(
        function(data) {
          if (!data.config) {
            console.log("Server error occured.");
          }
          deferred.resolve(data);
        },
        function(error) {
          deferred.reject(error);
        }
      );

      return deferred.promise;
    }
  }
})();
