<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en" ng-csp="" ng-app="HMZAdminApp"> <!--<![endif]-->

	<head>

		<meta charset="utf-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<title>La Vendimia</title>
		
		<!-- mobile meta -->
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.ico">

		<!--[if IE]>
			<link rel="shortcut icon" href="favicon.ico">
		<![endif]-->
		<!-- or, set /favicon.ico for IE10 win -->
		<meta name="msapplication-TileColor" content="#f01d4f">

		<!-- CSS -->		
		<link rel="stylesheet" type="text/css" class="ui" href="assets/css/semantic.min.css">
		<link rel="stylesheet" type="text/css" class="ui" href="assets/css/main.css">
		<link rel="stylesheet" type="text/css" class="ui" href="assets/css/jquery-ui.min.css">
		

	</head>

	<body class="main-wrapper">
		
		<!--[if lt IE 8]>
		    <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<div class="ui bottom attached segment pushable">
		<!-- Sidebar -->
		<side-bar class="ui visible inverted left vertical sidebar menu"></side-bar>

		<!-- Main view for templates -->
		<div data-ng-view="" class="pusher" id="main-content"></div>
		</div>
	</body>

	<!-- Vendors -->
	<!-- build:nonangularlibs assets/js/nonangularlibs.js -->
	<script type="text/javascript" src="assets/js/nonangular/jquery-1.11.2.min.js"></script>
	<script type="text/javascript" src="assets/js/nonangular/semantic.min.js"></script>
	<script type="text/javascript" src="assets/js/nonangular/Chart.min.js"></script>
	<script type="text/javascript" src="assets/js/nonangular/moment.min.js"></script>
	<script type="text/javascript" src="assets/js/nonangular/jquery-ui.min.js"></script>
	<!-- endbuild -->

	<!-- Non-angular libraries -->
	<script type="text/javascript" src="assets/js/main.js"></script>
	<!-- endbuild -->

	<!-- Angular external libraries for application -->
	<script type="text/javascript" src="assets/js/angular/angular.js"></script>
	<script type="text/javascript" src="assets/js/angular/angular-route.min.js"></script>
	<script type="text/javascript" src="assets/js/angular/angular-sanitize.min.js"></script>
	<script type="text/javascript" src="assets/js/angular/angular-moment.min.js"></script>
	
	<!-- Angular components -->
	<script type="text/javascript" src="assets/app/app.js"></script>
	<script type="text/javascript" src="assets/app/config.js"></script>
	<script type="text/javascript" src="assets/components/services/queryService.service.js"></script>
	<script type="text/javascript" src="assets/components/services/LocalStorage.service.js"></script>
	<script type="text/javascript" src="assets/components/directives/sidebar.directive.js"></script>

	<!-- Application sections -->
	<script type="text/javascript" src="assets/app/factory.js"></script>
	<script type="text/javascript" src="assets/app/controller.js"></script>
	<script type="text/javascript" src="assets/app/SaleController.js"></script>
	<script type="text/javascript" src="assets/app/SaleAddController.js"></script>
	<script type="text/javascript" src="assets/app/SysHealthController.js"></script>
</html>
