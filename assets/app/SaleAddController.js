/**
 * Sale application controller
 *
 */
(function() {
  angular
    .module("HMZAdminApp")
    .controller("SaleAddController", SaleAddController);

  SaleAddController.$inject = [
    "site.config",
    "QueryService",
    "$rootScope",
    "$timeout",
    "$location"
  ];

  function SaleAddController(
    SiteConfig,
    QueryService,
    $rootScope,
    $timeout,
    $location
  ) {
    // 'controller as' syntax
    var self = this;
    self.items = [];
    self.payments = [];
    self.rfc = "";
    self.idClient = 0;
    self.paymentSection = false;
    // Totales
    self.initialPayment = 0;
    self.bonus = 0;
    self.total = 0;

    self.paymentsMonthly = 0;
    /**
     * Update a Quantity
     */
    self.updateQuantity = function(id, quantity) {
      var value = quantity.target.value;
      var pos = self.items
        .map(function(e) {
          return e.id;
        })
        .indexOf(id);
      if (value > 0) {
        if (pos > -1) {
          self.items[pos].importe = self.items[pos].precio * value;
          self.items[pos].cantidad = value;
          self.updateTotal();
        } else {
          alert("No existe el artículo");
        }
      } else {
        quantity.target.value = self.items[pos].cantidad;
        alert("La cantidad debe ser mayor a 0");
      }
    };

    /**
     * Delete a item
     */
    self.deleteItem = function(id) {
      var pos = self.items
        .map(function(e) {
          return e.id;
        })
        .indexOf(id);
      if (pos > -1) {
        self.items.splice(pos, 1);
      }
    };
    /**
     * Next page
     */
    self.nextPage = function() {
      self.paymentSection = true;
      self.generatePayments();
    };
    /**
     * Initial
     */
    self.init = function() {
      $(function() {
        $("#cliente").autocomplete({
          source: function(request, response) {
            var query = {
              query: request.term
            };
            QueryService.queryClient(query).then(function(res) {
              var data = res.data;
              response(data);
            });
          },
          minLength: 3,
          select: function(event, ui) {
            self.rfc = ui.item.rfc;
            self.idClient = ui.item.id;
          }
        });
        $("#articulo").autocomplete({
          source: function(request, response) {
            var query = {
              query: request.term
            };
            QueryService.queryItem(query).then(function(res) {
              var data = res.data;
              response(data);
            });
          },
          minLength: 3,
          select: function(event, ui) {
            if (self.existItem(ui.item.id)) {
              var id = ui.item.id;
              var descripcion = ui.item.label;
              var modelo = ui.item.modelo;
              var cantidad = 1;
              var precio = ui.item.precio;
              var importe = precio * cantidad;
              self.items.push({
                id: id,
                descripcion: descripcion,
                modelo: modelo,
                cantidad: cantidad,
                precio: precio,
                importe: importe
              });
              self.updateTotal();
              self.itemSelected = "";
            } else {
              alert("Articulo ya está en el carrito");
            }
            self.itemSelected = "";
          }
        });
      });
    };
    /**
     * validate if exist the item in array
     */
    self.existItem = function(id) {
      var pos = self.items
        .map(function(e) {
          return e.id;
        })
        .indexOf(id);
      return pos == -1;
    };
    self.updateTotal = function() {
      var amount = 0;
      for (var key in self.items) {
        amount += self.items[key].importe;
      }
      self.initialPayment =
        Math.round((self.commission.enganche / 100) * amount * 100) / 100;
      self.bonus =
        Math.round(
          self.initialPayment *
            ((self.commission.tasa_financiamiento *
              self.commission.plazo_maximo) /
              100) *
            100
        ) / 100;
      self.total =
        Math.round((amount - self.initialPayment - self.bonus) * 100) / 100;
      self.generatePayments();
    };
    /**
     * Generate the payments
     */
    self.generatePayments = function() {
      self.payments = [];
      var price =
        Math.round(
          (self.total /
            (1 +
              (self.commission.tasa_financiamiento *
                self.commission.plazo_maximo) /
                100)) *
            100
        ) / 100;
      for (var plazo = 3; plazo <= self.commission.plazo_maximo; plazo += 3) {
        var payments = plazo;
        var total =
          Math.round(
            price *
              (1 + (self.commission.tasa_financiamiento * plazo) / 100) *
              100
          ) / 100;
        var monthly = Math.round((total / plazo) * 100) / 100;
        var saving = Math.round((self.total - total) * 100) / 100;
        self.payments.push({
          payments: payments,
          total: total,
          monthly: monthly,
          saving: saving
        });
      }
    };
    /**
     * Set the payment
     */
    self.setPayment = function(radio) {
      self.paymentsMonthly = radio.target.value;
    };
    /**
     * Save a sale
     */
    self.saveSale = function() {
      var meses = self.paymentsMonthly;
      var opcion = (meses / 3) - 1;
      var detallesventa = [];
      for (var key in self.items) {
        detallesventa.push({
          id: self.items[key].id,
          importe: self.items[key].importe,
          cantidad: self.items[key].cantidad
        });
      }

      var datos = {
        venta: {
          clientes_idclientes: self.idClient,
          total: self.payments[opcion].total,
          meses: meses,
          abono: self.payments[opcion].monthly,
          enganche: self.initialPayment
        },
        detallesventa: detallesventa
      };
      $(".main-wrapper .pushable").addClass("loading");
      QueryService.querySaveSale({}, datos).then(function(response) {
        var data = response.data;
        alert("Bien Hecho, Tu venta ha sido registrada correctamente");
        $(".main-wrapper .pushable").removeClass("loading");
        $location.path("/sale");
      });
    };
    self.init();
    $rootScope.$emit("onLocationChangeSuccess", $location.$$path);
    $(".main-wrapper .pushable").addClass("loading");
    QueryService.queryCommission().then(function(response) {
      var data = response.data;
      self.commission = data;
      $(".main-wrapper .pushable").removeClass("loading");
    });
    QueryService.queryIdSale().then(function(response) {
      var data = response.data;
      self.code = data.id;
    });
  }
})();
