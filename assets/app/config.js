(function() {
  /**
   * Place to store API URL or any other constants
   * Usage:
   *
   * Inject CONSTANTS service as a dependency and then use like this:
   * CONSTANTS.API_URL
   */
  angular.module("HMZAdminApp").constant("site.config", {
    APP_NAME: "La Vendimia",
    SERVER: {
      NAME: "cuboidNodezDs12",
      START_DATE: "2016-06-03",
      END_DATE: "2016-06-16"
    },
    SEVERITYLIST: [
      { name: "Very High", value: "VERY_HIGH" },
      { name: "High", value: "HIGH" },
      { name: "Medium", value: "MEDIUM" },
      { name: "Low", value: "LOW" }
    ],
    DASHBOARD_API_URL: "assets/rest/dashboard_back_end_response.json",
    SYSTEMHEALTH_API_URL: "assets/rest/system_health_report_response.json",
    CONFIGURATION_API_URL: "/configuracion/get",
    CLIENT_API_URL: "/clientes/buscar",
    ITEM_API_URL: "/articulos/buscar",
    SAVE_SALES_API_URL: "/ventas/add",
    SALES_API_URL: "ventas/show",
    SALES_ID_API_URL: "ventas/id",
    PROJECTS: [
      {
        name: "Linkein",
        url:
          "https://www.linkedin.com/in/carlos-adolfo-ruiz-rodr%C3%ADguez-2a164971/"
      }
    ]
  });
})();
