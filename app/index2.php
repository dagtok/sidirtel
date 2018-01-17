<?php
	$cursor = null;

	if(isset($_POST['search-param'])){	
		/*
		$m = new MongoClient("mongodb://heroku_m4b97brj:5rm1ub4c09s4dhn8m266i34669@ds141108.mlab.com:41108/heroku_m4b97brj");
		$db = $m->selectDB('heroku_m4b97brj');
		$collection = new MongoCollection($db, 'personal');
		
		//,'$language' => "es"
		$cursor = $collection->find(['$text' => ['$search' => $_POST['search-param'] ]]);
		*/
		///
		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");

		$query = new MongoDB\Driver\Query( [ 'nombre' => $_POST['search-param'] ] );

		$cursor = $manager->executeQuery('sidirtel.personal', $query);
		$cursor = $cursor->toArray();
		
		/*
		echo "<pre>";
		print_r($_POST);
		echo "</pre>";
		exit();
		*/
	}
?>
<!DOCTYPE html>
<html lang="es-MX">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Directorio Telefónico del IPN</title>
		
		<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">

		<script
		src="https://code.jquery.com/jquery-3.1.1.min.js"
		integrity="sha256-hVVnYaiADRTO2PzUGmuLJr8BLUSjGIZsDYGmIJLv2b8="
		crossorigin="anonymous"></script>
    
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<script src="jquery.dataTables.min.js"></script>
		<link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
		<style>
			.dataTables_filter, .dataTables_info { display: none; }
			
			body {
			    background: #f8f8f8;
			    font-family: 'Roboto', sans-serif;
			    margin: 0px;
			    padding: 0px;
			    font-size: 11px;
			}

			.footer {
			    margin-top: 5px;
			    padding-top: 3px;
			    background-color: #603;
			    width: 100%;
			    color: #FFF;
			    text-align: center;
			    font-size: 11px;
			    height: 40px;
			}
			#contenido {
			    width: 960px;
			    margin: 0 auto;
			    margin-top: 10px;
			    min-height: 500px;
			    border: #EBEBEB 3px solid;
			    background-color: #FFF;
			    padding: 10px;
			}

			/* SEARCH BAR */
			#flipkart-navbar {
			    background-color: #EBEBEB;
    			border-top: 7px solid #510635;
			}

			.row1{
			    padding-top: 10px;
			}

			.row2 {
			    padding-bottom: 5px	;
			}

			.flipkart-navbar-input {
			    padding: 11px 16px;
			    border-radius: 2px 0 0 2px;
			    border: 0 none;
			    outline: 0 none;
			    font-size: 15px;
			}

			.flipkart-navbar-button {
			    background-color: #603;
			    border: 1px solid #603;
			    border-radius: 0 2px 2px 0;
			    color: #565656;
			    padding: 10px 0;
			    height: 43px;
			    cursor: pointer;
			}

			.cart-button {
			    background-color: #2469d9;
			    box-shadow: 0 2px 4px 0 rgba(0, 0, 0, .23), inset 1px 1px 0 0 hsla(0, 0%, 100%, .2);
			    padding: 10px 0;
			    text-align: center;
			    height: 41px;
			    border-radius: 2px;
			    font-weight: 500;
			    width: 120px;
			    display: inline-block;
			    color: #FFFFFF;
			    text-decoration: none;
			    color: inherit;
			    border: none;
			    outline: none;
			}

			.cart-button:hover{
			    text-decoration: none;
			    color: #fff;
			    cursor: pointer;
			}

			.cart-svg {
			    display: inline-block;
			    width: 16px;
			    height: 16px;
			    vertical-align: middle;
			    margin-right: 8px;
			}

			.item-number {
			    border-radius: 3px;
			    background-color: rgba(0, 0, 0, .1);
			    height: 20px;
			    padding: 3px 6px;
			    font-weight: 500;
			    display: inline-block;
			    color: #fff;
			    line-height: 12px;
			    margin-left: 10px;
			}

			.upper-links {
			    display: inline-block;
			    padding: 0 11px;
			    line-height: 23px;
			    font-family: 'Roboto', sans-serif;
			    letter-spacing: 0;
			    color: inherit;
			    border: none;
			    outline: none;
			    font-size: 12px;
			}

			.dropdown {
			    position: relative;
			    display: inline-block;
			    margin-bottom: 0px;
			}

			.dropdown:hover {
			    background-color: #fff;
			}

			.dropdown:hover .links {
			    color: #000;
			}

			.dropdown:hover .dropdown-menu {
			    display: block;
			}

			.dropdown .dropdown-menu {
			    position: absolute;
			    top: 100%;
			    display: none;
			    background-color: #fff;
			    color: #333;
			    left: 0px;
			    border: 0;
			    border-radius: 0;
			    box-shadow: 0 4px 8px -3px #555454;
			    margin: 0;
			    padding: 0px;
			}

			.links {
			    color: #fff;
			    text-decoration: none;
			}

			.links:hover {
			    color: #fff;
			    text-decoration: none;
			}

			.profile-links {
			    font-size: 12px;
			    font-family: 'Roboto', sans-serif;
			    border-bottom: 1px solid #e9e9e9;
			    box-sizing: border-box;
			    display: block;
			    padding: 0 11px;
			    line-height: 23px;
			}

			.profile-li{
			    padding-top: 2px;
			}

			.largenav {
			    display: none;
			}

			.smallnav{
			    display: block;
			}

			.smallsearch{
			    margin-left: 15px;
			    margin-top: 15px;
			}

			.menu{
			    cursor: pointer;
			}

			@media screen and (min-width: 768px) {
			    .largenav {
			        display: block;
			    }
			    .smallnav{
			        display: none;
			    }
			    .smallsearch{
			        margin: 0px;
    				padding-top: 18px;
			    }
			}

			/*Sidenav*/
			.sidenav {
			    height: 100%;
			    width: 0;
			    position: fixed;
			    z-index: 1;
			    top: 0;
			    left: 0;
			    background-color: #fff;
			    overflow-x: hidden;
			    transition: 0.5s;
			    box-shadow: 0 4px 8px -3px #555454;
			    padding-top: 0px;
			}

			.sidenav a {
			    padding: 8px 8px 8px 32px;
			    text-decoration: none;
			    font-size: 25px;
			    color: #818181;
			    display: block;
			    transition: 0.3s
			}

			.sidenav .closebtn {
			    position: absolute;
			    top: 0;
			    right: 25px;
			    font-size: 36px;
			    margin-left: 50px;
			    color: #fff;        
			}

			@media screen and (max-height: 450px) {
			  .sidenav a {font-size: 18px;}
			}

			.sidenav-heading{
			    font-size: 36px;
			    color: #fff;
			}
		</style>
		<script>
			$(document).ready(function(){
				var oTable = $('#personal').DataTable();
				$('#searchParam').keyup(function(){
							oTable.search($(this).val()).draw() ;
				}).focus();
			});
		</script>
  </head>
  <body>

	<div id="flipkart-navbar">
	    <div>
	        <div class="row row2">
	            <div class="col-sm-3">
	                <h2 style="margin:0px;"><span class="smallnav menu" onclick="openNav()">☰ Brand</span></h2>
	                <h1 style="margin:0px;">
	                	<span class="largenav">
	                </span>
	                </h1>
	                <a href="index.php">
		                <table class="table" style="padding: 0;margin: 0;">
							<tbody>
								<tr>
									<td style="text-align: right;">
										<img src="assets/logo_ipn.png" style="height: 60px;">
									</td>
									<td style="text-align: left;padding-top: 20px;">
										<p>Instituto Politécnico Nacional<br> "La Técnica al Servicio de la Patria"</p>
									</td>
							</tbody>
						</table>
					</a>
	            </div>
	            <div class="flipkart-navbar-search smallsearch col-sm-6">
	            	<div class="row">
	                	<form method="POST">
		                    <input type="text" class="flipkart-navbar-input col-xs-11" 
								    name="buscar" 
								    placeholder="Escribe una Unidad o Área, nombre de la persona o simplemente un número de extensión. " 
								    value="<?php echo (isset($_POST['search-param']) ? $_POST['search-param'] : null) ?>" 
								    id="searchParam">

		                    <button class="flipkart-navbar-button col-xs-1" type="submit">
		                        <span class="glyphicon glyphicon-search" style="color: white" aria-hidden="true"></span>
		                    </button>
						</form>

	                </div>
	            </div>
	            <div class="col-sm-3" style="padding-top: 6px;padding-left: 60px;">
		            Números telefónicos de conmutador:
		            <ul>
						<li>+52(55) 5729-6000</li>
						<li>+52(55) 5729-6300</li>
						<li>+52(55) 5624-2000</li>
					</ul>
	            </div>
	        </div>
	    </div>
	</div>
	<div id="mySidenav" class="sidenav">
	    <div class="container" style="background-color: #2874f0; padding-top: 10px;">
	        <span class="sidenav-heading">Home</span>
	        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
	    </div>
	    <a href="http://clashhacks.in/">Link</a>
	    <a href="http://clashhacks.in/">Link</a>
	    <a href="http://clashhacks.in/">Link</a>
	    <a href="http://clashhacks.in/">Link</a>
	</div>


	<div class="row" id="contenido">
		<div class="col-md-12" style="padding-bottom: 40px;">
				<h4>Resultados de búsqueda</h4>
				<table class="table" id="personal">
					<thead>
						<td>Ext.</td>
						<td>Persona</td>
						<td>Cargo o función</td>
						<td>Área</td>
						<td>Unidad</td>
						<td>Nombre de la unidad</td>
					</thead>
					<tbody>
					<?php
					foreach ($cursor as $doc) {
					    echo "
						<tr>
							<td>".$doc->extension."</td>
							<td>".$doc->nombre."</td>
							<td>".$doc->cargo."</td>
							<td>".$doc->area."</td>
							<td>".$doc->sigla_unidad."</td>
							<td>".$doc->unidad."</td>
						</tr>
					    ";
					}
					?>
					</tbody>
				</table>
	    </div>
	    <div class="col-md-12 footer" style="padding-top: 12px">
	    	Unidad Profesional "Adolfo López Mateos", Zacatenco, Del. Gustavo A. Madero, C.P. 07738, México D.F.Tels.: 57296000, 57296300, 56242000
	    </div>
	</div>
  </body>
</html>