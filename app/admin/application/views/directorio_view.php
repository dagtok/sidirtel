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
							<li class="active">
								<a href="<?php echo base_url('index.php/directorio'); ?>">
									<span aria-hidden="true" class="glyphicon glyphicon-phone-alt"></span>
									Directorio Telefónico
								</a>
							</li>
							<?php if($usuario['tipo'] == 'manager') { ?>
							<li>
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
							<?php } ?>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li>
								<a href="../navbar-static-top/">
									<?php echo $usuario['nombre']; ?>
									<?php //echo $usuario['unidad']; ?>
									<?php echo $usuario['tipo']; ?>
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
			<form method="post">
				<div class="row">
					<?php if($usuario['tipo'] == 'manager'){ ?>
					<div class="col-md-6">
						<div class="form-group">
							<label for="clasificacion_ur">Clasificación de la unidad:</label>
							<select 
								required="required" 
								class="form-control clasificacion_ur" 
								onchange="filtrarUnidadesPorClasificacion(this)"
								name="clasificacion_ur">
							   	<option></option>
							   	<?php
							   	foreach ($clasificaciones as $clasificacion) {
							   		$selected = (isset($info_persona->clasificacion_ur) && $info_persona->clasificacion_ur == $clasificacion->clasificacion) ? 'selected' : null;
									echo '<option '.$selected.' value="'.$clasificacion->clasificacion.'">'.$clasificacion->descripcion.'</option>';
								}
							   	?>
						   	</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="nombre-unidad">Unidad:</label>
							<select required="required" class="form-control" id="unidad_id" name="unidad_id">
							   	<option></option>
							   	<?php
							   	foreach ($unidades as $unidad) {
									$selected = ($info_persona->unidad_id == $unidad->clave_ur) ? 'selected="selected"' : null;
									echo '<option value="'.$unidad->clave_ur.'" '.$selected.'>'.$unidad->unidad.'</option>';
								}
							   	?>
						   	</select>
						</div>
					</div>
					<?php } elseif($usuario['tipo'] == 'unidad'){ ?>
						<input type="hidden" name="unidad_id" value="<?php echo $usuario['unidad_id']; ?>">
						<input type="hidden" name="clasificacion_ur" value="<?php echo $usuario['clasificacion_unidad_id']; ?>">
					<?php } ?>

					<div class="col-md-6">
						<div class="form-group">
							<label for="extension">Extension:</label>
						    <input type="number" class="form-control" 
						    value="<?php echo $info_persona->extension; ?>" 
						    name="extension" size="7" required="required">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						    <label for="nombre">Nombre de la persona:</label>
						    <input type="text" class="form-control" 
						    value="<?php echo $info_persona->nombre; ?>" 
						    name="nombre" required="required">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						    <label for="cargo">Cargo:</label>
						    <input type="text" class="form-control" 
						    value="<?php echo $info_persona->cargo; ?>" 
						    name="cargo" required="required"s>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
						    <label for="area">Area:</label>
						    <input type="text" class="form-control" name="area" 
						    value="<?php echo $info_persona->area; ?>" 
						    required="required">
						</div>
					</div>
				</div>
				<input type="hidden" name="unidad" id="unidad" value="<?php echo (strlen($info_persona->unidad) > 0) ? $info_persona->unidad : $usuario['unidad']; ?>">

				<?php if (isset($id)) { ?>
					<input type="hidden" name="id" value="<?php echo $id; ?>">	
				<?php } ?>
				
				<button type="submit" class="btn btn-default">Enviar</button>

				<a href="<?php echo base_url('directorio'); ?>" class="btn btn-default">Limpiar</a>
			</form>
		</div>
		<div class="col-md-12" style="padding-top: 40px; padding-bottom: 40px;">
			<div class="row">
				<div class="col-md-12">
					<h4>Resultados de búsqueda</h4>
					<table class="table" id="personal">
						<thead>
							<td>Ext.</td>
							<td>Persona</td>
							<td>Cargo o función</td>
							<td>Área</td>
							<td>Unidad</td>
							<td>Nombre de la unidad</td>
							<td>Acción</td>
						</thead>
						<tbody>
							<?php
							foreach ($personas as $persona) {
							    echo "
								<tr>
									<td>".$persona->extension."</td>
									<td>".$persona->nombre."</td>
									<td>".$persona->cargo."</td>
									<td>".$persona->area."</td>
									<td>".$persona->unidad_id."</td>
									<td>
										".$persona->unidad."
									</td>
									<td>
										<a  href=\"?id=".(string) $persona->_id."\"
											data-toggle=\"tooltip\" 
	                                    	data-placement=\"top\" 
	                                    	title=\"Clic para modificar informacion de ".$persona->nombre."\">
												<span aria-hidden=\"true\" class=\"glyphicon glyphicon-pencil\"></span>
										</a>
										<a  href=\"?action=delete&id=".(string) $persona->_id."\"
											data-toggle=\"tooltip\" 
	                                    	data-placement=\"top\" 
	                                    	title=\"Clic para ELIMINAR a ".$persona->nombre." del directorio.\">
											<span aria-hidden=\"true\" class=\"glyphicon glyphicon-trash\"></span>
										</a>
									</td>
								</tr>
							    ";
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
			$('[data-toggle="tooltip"]').tooltip();
		});

		function filtrarUnidadesPorClasificacion(elemento){
			var clasificacion_seleccionada = $(elemento).val();
			$('#unidad_id>option').remove();

			$.ajax({
			  method: "POST",
			  url: "<?php echo base_url('index.php/centros/filtrarPorNivel'); ?>",
			  dataType: "json",
			  data: { "clasificacion": clasificacion_seleccionada }
			}).done(function(escuelas) {
				$.each(escuelas, function (i, escuela) {
				    $('#unidad_id').append($('<option>', { 
				        value: escuela.value,
				        text : escuela.text 
				    }));
				});
			});
		}

		$( ".clasificacion_ur" ).change(function() {
		  //alert( "Handler for .change() called." );
		  $('#clasificacion').val($('.clasificacion_ur option:selected').text());
		});

		$( "#unidad_id" ).change(function() {
		  $('#unidad').val($('#unidad_id option:selected').text());
		});
	</script>
 </body>
</html>