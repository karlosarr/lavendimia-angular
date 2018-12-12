/**
 * Sale application controller
 *
 */
(function() {
  angular.module("HMZAdminApp").controller("SaleController", SaleController);

  SaleController.$inject = [
    "site.config",
    "QueryService",
    "$rootScope",
    "$timeout",
    "$location"
  ];

  function SaleController(
    SiteConfig,
    QueryService,
    $rootScope,
    $timeout,
    $location
  ) {
    // 'controller as' syntax
    var self = this;
    self.payments = [];

    QueryService.queryCommission().then(function(response) {
      var data = response.data;
      self.commission = data;
    });
    QueryService.querySale().then(function(response) {
      var data = response.data;
      self.payments = data;
    });
  }
})();
