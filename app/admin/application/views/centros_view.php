<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
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

    <script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <style>
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
			    background-color: #5e1c17;
			    width: 100%;
			    color: #FFF;
			    text-align: center;
			    font-size: 11px;
			    height: 40px;
			}
			#contenido {
			    width: 960px;
			    margin: 0 auto;
			    min-height: 500px;
			    border: #EBEBEB 3px solid;
			    background-color: #FFF;
			    padding: 10px;
			}
	</style>
  </head>
 <body>
 	<div class="row" id="contenido">
		<div class="col-md-12">
			<table class="table" style="padding: 0;margin: 0;">
				<tbody>
					<tr>
						<td style="text-align: right;">
							<img src="<?php echo base_url('assets/logo_ipn.png'); ?>">
						</td>
						<td style="text-align: left;padding-top: 30px;">
							<p>Instituto Politécnico Nacional<br> "La Técnica al Servicio de la Patria"</p>
						</td>
						<td style="text-align: right;">
							<img class="resposive" src="<?php echo base_url('assets/logo_buscador.png'); ?>">
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<div class="col-md-12" style="background-color: #EBEBEB; border-top: 7px solid #510635">
			<nav class="navbar navbar-default">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">Sidirtel</a>
					</div>
					<div id="navbar" class="navbar-collapse collapse">
						<ul class="nav navbar-nav">
							<li>
								<a href="<?php echo base_url('index.php/directorio'); ?>">
									<span aria-hidden="true" class="glyphicon glyphicon-phone-alt"></span>
									Directorio Telefónico
								</a>
							</li>
							<li class="active">
								<a href="<?php echo base_url('index.php/centros'); ?>">
									<span aria-hidden="true" class="glyphicon glyphicon-home"></span>
									Catalogo de Unidades
								</a>
							</li>
							<li>
								<a href="<?php echo base_url('index.php/usuarios'); ?>">
									<span aria-hidden="true" class="glyphicon glyphicon-user"></span>
									Usuarios del sistema
								</a>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="../navbar-static-top/">
									<?php echo $usuario['nombre']; ?>
								</a>
							</li>
							<li>
								<a href="<?php echo base_url('index.php/login/salir'); ?>">Salir</a>
							</li>
						</ul>
					</div>
					<!--/.nav-collapse -->
				</div>
				<!--/.container-fluid -->
			</nav>
			<hr>
		</div>
		<div class="col-md-12" style="padding-top: 40px; padding-bottom: 40px;">
				<div class="row">
					<div class="col-md-12">
						<h4>Resultados de búsqueda</h4>
						<table class="table" id="personal">
							<thead>
								<tr>
									<td>UR</td>
									<td>NOMBRE DE LA UNIDAD</td>
									<td>SIGLA</td>
									<td>CLASIFICACION</td>
									<td>
										ACCIONES
									</td>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($unidades as $unidad) {
								    echo '
									<tr>
										<td>'.$unidad->clave_ur.'</td>
										<td>'.$unidad->unidad.'</td>
										<td>'.$unidad->sigla.'</td>
										<td>'.$unidad->clasificacion.'</td>
										<td>
											<a href="?id='.(string) $unidad->_id.'">Editar</a>
										</td>
									</tr>
								    ';
								}
								?>
							</tbody>
						</table>
				    </div>
				</div>
	    </div>
	    <div class="col-md-12 footer" style="padding-top: 12px">
	    	Unidad Profesional "Adolfo López Mateos", Zacatenco, Del. Gustavo A. Madero, C.P. 07738, México D.F.Tels.: 57296000, 57296300, 56242000
	    </div>
	</div>
	
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#personal').DataTable();
		});
	</script>
 </body>
</html>