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
							<li>
								<a href="<?php echo base_url('index.php/centros'); ?>">
									<span aria-hidden="true" class="glyphicon glyphicon-home"></span>
									Catalogo de Unidades
								</a>
							</li>
							<li class="active">
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
			
			<form method="post">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="clasificacion_unidad_id">Clasificacion de la unidad:</label>
							<select 
								required="required" 
								class="form-control clasificacion_unidad_id" 
								onchange="filtrarUnidadesPorClasificacion(this)"
								name="clasificacion_unidad_id">
							   	<option></option>
							   	<?php
							   	foreach ($clasificaciones as $clasificacion) {
							   		$selected = (isset($user_info->clasificacion_unidad_id) && $user_info->clasificacion_unidad_id == $clasificacion->clasificacion) ? 'selected="selected"' : null;

									echo '<option '.$selected.' value="'.$clasificacion->clasificacion.'">'.$clasificacion->descripcion.'</option>';
								} ?>
						   	</select>
						</div>
						<div class="form-group">
							<label for="nombre-unidad">Unidad:</label>
							<?php echo $user_info->unidad_id; ?>
							<select required="required" class="form-control" id="unidad_id" name="unidad_id">
							   	<option></option>
							   	<?php
							   	foreach ($unidades as $unidad) {
							   		$selected = ($user_info->unidad_id == $unidad->clave_ur) ? 'selected="selected"' : null;
									echo '<option  '.$selected.' value="'.$unidad->clave_ur.'">'.$unidad->unidad.'</option>';
								} ?>
						   	</select>
						</div>
						<div class="form-group">
							<label for="nombre">Nombre completo:</label>
						    <input type="text" class="form-control"
						    name="nombre"
						    value="<?php echo $user_info->nombre; ?>" 
						    size="7" required="required">
						</div>
					
						<div class="form-group">
							<label for="email">Correo electronico:</label>
						    <input type="text" class="form-control" 
						    value="<?php echo $user_info->email; ?>" 
						    name="email" 
						    required="required">
						</div>
					
						<div class="form-group">
							<label for="nombre">Tipo de cuenta:</label>
						    <select class="form-control" name="tipo">
						    	<?php $selected = ($user_info->tipo == 'manager') ? 'selected="selected"' : null; ?>
                                <option value="unidad">Responsable de Unidad</option>
                                <option <?php echo $selected; ?> value="manager">Manager</option>
                            </select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="usuario">Usuario:</label>
						    <input type="text" class="form-control"
						    value="<?php echo $user_info->usuario; ?>"
						    name="usuario" size="7" required="required">
						</div>
					
						<div class="form-group">
							<label for="password">Contraseña:</label>
						    <input type="password" class="form-control"
						    value="<?php echo $user_info->password; ?>" 
						    name="password" size="7" required="required">
						</div>
						<div class="form-group">
							<label for="confirm_password">Confirmación contraseña:</label>
						    <input type="password" class="form-control"
						    value="<?php echo $user_info->password; ?>" 
						    name="confirm_password" size="7" required="required">
						</div>
					</div>
				</div>
				
				<input type="hidden" name="unidad" id="unidad" value="<?php echo $user_info->unidad; ?>">

				<?php if (isset($id)) { ?>
					<input type="hidden" name="id" value="<?php echo $id; ?>">	
					
				<?php } ?>

				<button type="submit" class="btn btn-default">Enviar</button>
			</form>
			<!-- MODAL PARA RESETEAR PASSWORD -->
			<div class="modal fade" id="modalResetPassword" tabindex="-1" role="dialog" aria-labelledby="modalResetPasswordLabel">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			        <h4 class="modal-title" id="modalResetPasswordLabel">LA NUEVA CONTRASEÑA SE GENERO CON EXITO!</h4>
			      </div>
			      <div class="modal-body">
			        <table class="table">
			        	<tr>
			        		<td>
			        			<img src="<?php echo base_url('assets/reiniciar-password.png'); ?>">
			        		</td>
			        		<td>
			        			<table>
			        				<tr>
			        					<td>
			        						<span>USUARIO</span>
			        						<h1 id="newPasswordUserContainer">&nbsp;</h1>
			        					</td>
			        				</tr>
			        				<tr>
			        					<td>
			        						<span>PASSWORD</span>
			        						<h1 id="newPasswordContainer">&nbsp;</h1>
			        					</td>
			        				</tr>
			        			</table>
			        		</td>
			        	</tr>
			        </table>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			        <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
			      </div>
			    </div>
			  </div>
			</div>
		</div>
		
		<div class="col-md-12" style="padding-top: 40px; padding-bottom: 40px;">
			<div class="row">
				<div class="col-md-12">
					<h4>Resultados de búsqueda</h4>
					<table class="table" id="usuarios_sistema">
                        <thead>
                            <tr>
                                <td>Clasificación</td>
                                <td>Unidad ID</td>
								<td>Unidad</td>
                                <td>Nombre completo</td>
                                <td>Correo electronico</td>
                                <td>Tipo de cuenta</td>
                                <td>Status</td>
                                <td>Usuario</td>
                                <!-- <td>Contraseña</td> -->
                                <td>Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                        	<?php
							foreach ($usuarios as $usuario) {
							    echo "
								<tr>
									<td>".$usuario->clasificacion_unidad_id."</td>
						            <td>".$usuario->unidad_id."</td>
									<td>".$usuario->unidad."</td>
						            <td>".$usuario->nombre."</td>
						            <td>".$usuario->email."</td>
						            <td>".$usuario->tipo."</td>
						            <td>".$usuario->status."</td>
						            <td>".$usuario->usuario."</td>
						            <!-- <td>".$usuario->password."</td> -->
									<td>
                                    	<ul style=\"list-style:none;margin:0; padding:0;\">
	                                    	<li style=\"float:left; padding:2px\">
	                                    		<a href=\"?id=".(string) $usuario->_id."\"
	                                    			data-toggle=\"tooltip\" 
	                                    			data-placement=\"top\" 
	                                    			title=\"Da clic, para modificar información de ".$usuario->nombre." \">
	                                    			<span aria-hidden=\"true\" class=\"glyphicon glyphicon-pencil\"></span>
	                                    		</a>
	                                    	</li>
	                                    	<li style=\"float:left; padding:2px\">
	                                    		<a href=\"?action=delete&id=".(string) $usuario->_id."\"
	                                    			data-toggle=\"tooltip\" 
	                                    			data-placement=\"top\" 
	                                    			title=\"Eliminar a ".$usuario->nombre." del sistema.\">
	                                    			<span aria-hidden=\"true\" class=\"glyphicon glyphicon-trash\"></span>
	                                    		</a>
	                                    	</li>
	                                    	<li style=\"float:left; padding:2px\">
	                                    		<a href=\"#\" onclick=\"mostrarPassword('".$usuario->usuario."','".(string) $usuario->_id."')\"
	                                    			data-toggle=\"tooltip\" 
	                                    			data-placement=\"top\" 
	                                    			title=\"Ver la contraseña de ".$usuario->nombre."\">
	                                    			<span aria-hidden=\"true\" class=\"glyphicon glyphicon-eye-open\"></span>
	                                    		</a>
	                                    	</li>
	                                    	<li style=\"float:left; padding:2px\">
	                                    		<a href=\"#\" onclick=\"reiniciarPassword('".$usuario->usuario."','".(string) $usuario->_id."')\"
	                                    			data-toggle=\"tooltip\" 
	                                    			data-placement=\"top\" 
	                                    			title=\"Crear una nueva contraseña de forma automatica para ".$usuario->nombre."\">
	                                    			<span aria-hidden=\"true\" class=\"glyphicon glyphicon-refresh\"></span>
	                                    		</a>
	                                    	</li>
	                                    	<li style=\"float:left; padding:2px\">
	                                    		<a>";
		                                    		if($usuario->status == 'activo'){
		                                    			echo "
		                                    			<a href=\"?action=deactivate&id=".(string) $usuario->_id."\"
			                                    			data-toggle=\"tooltip\" 
			                                    			data-placement=\"top\" 
			                                    			title=\"Da clic, para que ".$usuario->nombre." no pueda ingresar a esta plataforma\">
		                                    				<span aria-hidden=\"true\" class=\"glyphicon glyphicon-ok-sign\"></span>
		                                    			</a>
		                                    			";
		                                    		} elseif($usuario->status == 'inactivo'){
		                                    			echo "
		                                    			<a href=\"?action=activate&id=".(string) $usuario->_id."\"
		                                    				data-toggle=\"tooltip\" 
			                                    			data-placement=\"top\" 
			                                    			title=\"Da clic, para permitir que ".(string) $usuario->nombre." pueda ingresar a esta plataforma.\">
		                                    				<span aria-hidden=\"true\" class=\"glyphicon glyphicon-remove-sign\"></span>
		                                    			</a>
		                                    			";
		                                    		}
	                                    			echo "
	                                    		</a>
	                                    	</li>
                                    	<ul>
									</td>
								</tr>";
							} ?>
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
            $('#usuarios_sistema').DataTable();
            //$('#modalResetPassword').modal('show');
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

		function reiniciarPassword(usuario, user_id){
			
			$.ajax({
			  method: "POST",
			  url: "<?php echo base_url('index.php/usuarios/reiniciarPassword'); ?>",
			  data: { "id": user_id }
			}).done(function(nuevo_password) {
				$('#newPasswordUserContainer').text(usuario);
				$('#newPasswordContainer').text(nuevo_password);	
				$('#modalResetPassword').modal('show');
			});
		}

		function mostrarPassword(usuario, user_id){
			
			$.ajax({
			  method: "POST",
			  url: "<?php echo base_url('index.php/usuarios/mostrarPassword'); ?>",
			  data: { "id": user_id }
			}).done(function(password) {
				$('#newPasswordUserContainer').text(usuario);
				$('#newPasswordContainer').text(password);	
				$('#modalResetPassword').modal('show');
			});
		}
		
		$( "#unidad_id" ).change(function() {
		  $('#unidad').val($('#unidad_id option:selected').text());
		});
	</script>
 </body>
</html>