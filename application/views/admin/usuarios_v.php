<script type="text/javascript" src="<?=base_url()?>application/views/app/sb-admin-v2/js/jquery-dataui.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{


		//cargar la tabla con los datos
		$("#tabla-usuarios").tablaAjax({
			urldatos: "admin/gestion_usuarios/lista",
			fuente:"json",
			animacion: "#ajaxLoadAni",
			columnas: Array(
				"<td>U{codigo}</td>",
				"<td>{username}</td>",
				"<td>{nombre}</td>",
				"<td>{rol}</td>",
				"<td class='action col-md-2'><div class='text-center'>"+
				"<a href='#modal-editar-usuario' class='edit btn btn-outline btn-warning btn-sm' data-toggle='modal' data-target='#modal-editar-usuario' data-codigo='{codigo}' data-username='{username}' data-nombre='{nombre}' data-identificacion='{identificacion}' data-rol='{rol}'	data-correo='{correo}' data-telefono='{telefono}'><i class='fa fa-pencil'/></a> "+
				"<a href='#modal-eliminar-usuario' class='delete btn btn-outline btn-danger btn-sm' data-toggle='modal' data-target='#modal-eliminar-usuario' data-codigo='{codigo}' data-username='{username}'><i class='fa fa-trash-o'/></a>"+
				"</div></td>"
				)
		});



		$("#boton-crear").click(function() {
			$("#modal-crear-usuario").enviarModalAjax({
				animacion: "#ajaxLoadAni",
				divNotificaciones:"#notificaciones",
				funcionActualizar:'$("#tabla-usuarios").tablaAjax();'
			});
		});



	//Accion enlaces eliminar
		$(document).on("click", ".delete", function () {
			$('#codigo-usuario-eliminar').val( $(this).data('codigo'));
			$('#nombre-usuario-eliminar').html( $(this).data('username'));
		});


	// Funcion confirmar eliminar
		$("#boton-eliminar").click(function() {
			$("#modal-eliminar-usuario").enviarModalAjax({
				animacion: "#ajaxLoadAni",
				divNotificaciones:"#notificaciones",
				funcionActualizar:'$("#tabla-usuarios").tablaAjax();'
			});
		});


		//Accion enlaces editar
		$(document).on("click", ".edit", function () {
			$('#modal-editar-usuario [name="codigo"]').val( $(this).data('codigo'));
			$('#modal-editar-usuario [name="username"]').val( $(this).data('username'));
			$('#modal-editar-usuario [name="username"]').val( $(this).data('username'));
			$('#modal-editar-usuario [name="nombre"]').val( $(this).data('nombre'));
			$('#modal-editar-usuario [name="identificacion"]').val( $(this).data('identificacion'));
			$('#modal-editar-usuario[name="rol"]').val( $(this).data('rol'));
			$('#modal-editar-usuario [name="correo"]').val( $(this).data('correo'));
			$('#modal-editar-usuario [name="telefono"]').val( $(this).data('telefono'));
		});


	// Funcion confirmar eliminar
		$("#boton-editar").click(function() {
			$("#modal-editar-usuario").enviarModalAjax({
				animacion: "#ajaxLoadAni",
				divNotificaciones:"#notificaciones",
				funcionActualizar:'$("#tabla-usuarios").tablaAjax();'
			});
		});

	});
</script>
<div class="row">
	<div id="ajaxLoadAni" class="col-md-2 col-md-offset-5">
		<img src="<?=$ruta_tema?>/img/ajax-loader.gif" alt="Ajax Loading Animation" />
	</div>
</div>

<div id="notificaciones" class="col-lg-12"></div>


<!-- Inicio modal crear usuario-->
 <div class="modal fade " id="modal-crear-usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-primary">
			<div class="modal-header modal-heading">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Crear nuevo usuario</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form role="form" method="post" action="admin/gestion_usuarios/insertar" id="formulario-crear-usuario">
						<div class="form-group col-lg-6">
							<label>Usuario del sistema</label>
							<input class="form-control" placeholder="Usuario" name="username" title="Ingrese letra primer nombre acompañado de primer apellido">
							<label>Contraseña</label>
							<input class="form-control" placeholder="Contraseña" type="password" name="password" title="Combíne letras y numeros">
							<label>Nombres y apellidos</label>
							<input class="form-control" placeholder="Nombres y apellidos" name="nombre">
							<label>Documento de identificación</label>
							<input class="form-control" placeholder="CC o RUT o PPT" name="identificacion">
						</div>
						<div class="form-group col-lg-6">
							<label>Rol</label>
							<select class="form-control" name="rol">
							<?php foreach($roles as $rol){?>
								<option value="<?=$rol?>"><?=$rol?></option>
							<?php } ?>
							</select>
							<label>Correo electrónico</label>
							<input class="form-control" placeholder="nombre@dominio" name="correo" type="email">
							<label>Teléfono</label>
							<input class="form-control" placeholder="Telefono" name="telefono">
						</div>
					</form>
			</div>
		<!-- /.row (nested) -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-success" id="boton-crear">Crear</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- Fin modal crear-usuario -->


<!-- Inicio modal eliminar usuario-->
<div class="modal fade " id="modal-eliminar-usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-danger">
			<div class="modal-header modal-heading">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Eliminar usuario</h4>
			</div>
				<div class="modal-body">
				<div class="row">
					<p class="text-center">¿Está seguro de eliminar el usuario: <strong id="nombre-usuario-eliminar" class="text-danger"></strong> ?<p>
					<form role="form" method="post" action="admin/gestion_usuarios/eliminar" id="formulario-eliminar-usuario">
						<input type="hidden" id="codigo-usuario-eliminar" name="codigo" value=""/>
					</form>
				</div>
			<!-- /.row (nested) -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-danger" id="boton-eliminar">Eliminar</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- Fin modal eliminar usuario -->


<!-- Inicio modal editar usuario-->
 <div class="modal fade " id="modal-editar-usuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-warning">
			<div class="modal-header modal-heading">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Editar usuario</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form role="form" method="post" action="admin/gestion_usuarios/editar" id="formulario-editar-usuario">
						<input type="hidden" name="codigo"/>
						<div class="form-group col-lg-6">
							<label>Usuario del sistema</label>
							<input class="form-control" placeholder="Usuario" name="username" title="Ingrese letra primer nombre acompañado de primer apellido">
							<label>Contraseña</label>
							<input class="form-control" placeholder="Contraseña" type="password" name="password" title="Combíne letras y numeros">
							<label>Nombres y apellidos</label>
							<input class="form-control" placeholder="Nombres y apellidos" name="nombre">
							<label>Documento de identificación</label>
							<input class="form-control" placeholder="CC o RUT o PPT" name="identificacion">
						</div>
						<div class="form-group col-lg-6">
							<label>Rol</label>
							<select class="form-control" name="rol">
							<option value="Administrador">Administrador</option>
								<option value="Operario">Operario</option>
								<option value="Auxiliar de logística">Auxiliar de logística</option>
								<option value="Auxiliar de producción">Auxiliar de producción</option>
								<option value="Vendedor">Vendedor</option>
								<option value="Jefe de logística">Jefe de logística</option>
								<option value="Jefe de producción">Jefe de producción</option>
							</select>
							<label>Correo electrónico</label>
							<input class="form-control" placeholder="nombre@dominio.com" name="correo" type="email">
							<label>Teléfono</label>
							<input class="form-control" placeholder="Telefono" name="telefono">
						</div>
					</form>
				</div>
		<!-- /.row (nested) -->
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
				<button type="button" class="btn btn-warning" id="boton-editar">Guardar cambios</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- Fin modal editar-usuario -->


<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div>Lista de usuarios
				<button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#modal-crear-usuario">Nuevo </button>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<div class="table-responsive">
				<table id="tabla-usuarios" class="table table-striped table-bordered table-hover">
					<thead class="active">
						<th class="header">Código</th>
						<th class="header">Login</th>
						<th class="header">Nombre</th>
						<th class="header">Rol</th>
						<th class="header">Acciones</th>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<p style="margin-bottom: 6px; text-align: center;"> ... </p>
<p><a href="admin/gestion_usuarios/enviar_mail">Enviar e-mail</a></p>
