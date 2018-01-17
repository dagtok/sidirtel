<?php
	$cursor = null;
	/*
	if(isset($_POST['search-param'])){	
		$manager = new MongoDB\Driver\Manager("mongodb://localhost:27017/sidirtel");

		$query = new MongoDB\Driver\Query(['$text' => ['$search' => $_POST['search-param'] ]]);

		$cursor = $manager->executeQuery('sidirtel.personal', $query);
		$cursor = $cursor->toArray();
		echo "<pre>";
		print_r($cursor);
		//print_r($_POST['search-param']);
		echo "</pre>";
		exit();
	}
	*/
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

		<link rel="stylesheet" href="admin/assets/js/jquery.autocomplete.css">

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

		<script src="admin/assets/js/jquery.autocomplete.js"></script>

		<script>
			$(document).ready(function(){
				$("#search-param").autocomplete({
					valueKey:'nombre',
					appendMethod:'replace',
					getTitle:function(item){
						return item.nombre
					},
					getValue:function(item){
						return item.nombre
					},	
				 	source:[
					  function( q,add ){
					   $.getJSON("/admin/index.php/directorio/buscar?s="+	encodeURIComponent(q),function(resp){
					   		add(resp)
					   	})
					  }
				 	]
				}).focus().click();

			    $('.search-panel .dropdown-menu').find('a').click(function(e) {
					e.preventDefault();
					var param = $(this).attr("href").replace("#","");
					var concept = $(this).text();
					$('.search-panel span#search_concept').text(concept);
					$('.input-group #search_param').val(param);
				});
				/*
				*/
			});
		</script>
		<style type="text/css">
			body{
				font-family: roboto;
			}
			.footer {
			    background-color: #603;
			    bottom: 0;
			    color: #fff;
			    font-size: 11px;
			    height: 40px;
			    padding-top: 11px;
			    position: fixed;
			    text-align: center;
			    width: 100%;
			}
		</style>
  </head>
  <body>
  	
  	<div style="top: 0px; background-color: white">
		<table class="table" style="margin-left: 20px;">
			<tr>
				<td>
					<table>
						<tr>
							<td>
								<img src="http://www.sidirtel.ipn.mx/Images/logotipoIPN.png" style="width: 45px;">
							</td>
							<td style="padding-left: 15px;">
								Instituto Politécnico Nacional<br>
								"La Técnica al Servicio de la Patria"
							</td>
						</tr>
					</table>
				</td>
				<td align="right">
					<img src="http://www.sidirtel.ipn.mx/Images/logoBuscador.png">
				</td>
			</tr>
		</table>
  	</div>
	<div class="container" style="margin-top: 5%;">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
		        <!-- Search Form -->
		        <form role="form" method="post" action="index2.php">

			        <!-- Search Field -->
		            <div class="row">
		                <h1 class="text-center" style="font-size: 70px;font-size: 75px;padding-bottom: 20px; color: gray;">
		                	SIDIRTEL
		                </h1>
		                <div class="form-group">
		                    <div class="input-group">

		                    	<div class="input-group-btn search-panel" style="display: none">
									<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
										<span id="search_concept">Filtrar por</span> <span class="caret"></span>
									</button>
									<ul class="dropdown-menu" role="menu">
										<li><a href="#contains">Contains</a></li>
										<li><a href="#its_equal">It's equal</a></li>
										<li><a href="#greather_than">Greather than ></a></li>
										<li><a href="#less_than">Less than < </a></li>
										<li class="divider"></li>
										<li><a href="#all">Anything</a></li>
									</ul>
								</div>

		                        <input 
		                        class="form-control"
		                        id="search-param" 
		                        name="search-param" 
		                        type="text"
		                        placeholder="Ingresa algun nombre" 
		                        style="
		                            background-color: white;
								    background-position: 10px 10px;
								    background-repeat: no-repeat;
								    padding: 19px;
								    font-size: 20px;" 
		                        required/>
		                        
		                        <span class="input-group-btn">
		                            <button class="btn" style="background-color: #603;color: white;padding: 9PX;" type="submit">
		                            	<span class="glyphicon glyphicon-search" aria-hidden="true">
		                            	<span style="font-family: roboto;font-size: 17px;">BUSCAR</span>
		                            </button>
		                        </span>
		                        </span>
		                    </div>
		                </div>
		            </div>
		            
		        </form>
		        <!-- End of Search Form -->
		        <center>
		        	<h4 style="color: #9d9d9d">Números telefónicos de conmutador:</h4>
					<ul style="list-style: none; padding: 0px; color: #9d9d9d">
						<li>+52(55) 5729-6000</li>
						<li>+52(55) 5729-6300</li>
						<li>+52(55) 5624-2000</li>
					</ul>
		        </center>
		    </div>
	    </div>
	</div>
	<div class="footer">
		Unidad Profesional "Adolfo López Mateos", Zacatenco, Del. Gustavo A. Madero, C.P. 07738, México D.F.
	</div>
  </body>
</html>