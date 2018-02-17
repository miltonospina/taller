<script type="text/javascript">
	$(document).ready(function() 
	{
	
	
		//cargar la tabla con los datos
		$("#tabla-cargos").tablaAjax({
			urldatos: "personal/gestion_cargos/lista",
			fuente:"json",
			animacion: "#ajaxLoadAni",
			columnas: Array(
				"<td>{codigo_ipsa}</td>",
				"<td>{nombre}</td>",
				"<td>{dependencia.direccion}</td>",
				"<td>{dependencia.seccion}</td>",
				"<td class='action col-md-2'><div class='text-center'>"+	
				"<a href='personal/gestion_cargos/ver_detalle/{codigo}' class='edit btn btn-outline btn-warning btn-sm' ><i class='fa fa-pencil'/></a> "+
				"<a href='#modal-eliminar-cargo' class='delete btn btn-outline btn-danger btn-sm' data-toggle='modal' data-target='#modal-eliminar-cargo' data-codigo='{codigo}' data-nombre='{nombre}'><i class='fa fa-trash-o'/></a> "+
				"</div></td>"
				)
		});
		
		

		$("#boton-crear").click(function() {
			$("#modal-crear-cargo").enviarModalAjax({
				animacion: "#ajaxLoadAni",
				divNotificaciones:"#notificaciones",
				funcionActualizar:'$("#tabla-cargos").tablaAjax();'
			});
		});
	
	
	
	
	
	
	//Accion enlaces eliminar
		$(document).on("click", ".delete", function () {
			$('#codigo-cargo-eliminar').val( $(this).data('codigo'));
			$('#nombre-cargo-eliminar').html( $(this).data('nombre'));
		});
	
	
	
	// Funcion confirmar eliminar
		$("#boton-eliminar").click(function() {
			$("#modal-eliminar-cargo").enviarModalAjax({
				animacion: "#ajaxLoadAni",
				divNotificaciones:"#notificaciones",
				funcionActualizar:'$("#tabla-cargos").tablaAjax();'
			});
		});
		
		
		
		
		
	var jefes = new Bloodhound({
			datumTokenizer: Bloodhound.tokenizers.obj.whitespace('value'),
			queryTokenizer: Bloodhound.tokenizers.whitespace,
			remote: 'personal/gestion_cargos/buscar/?term=%QUERY'
		});
	jefes.initialize();	
	
	$('#remote .typeahead').typeahead(null,{
		name: 'jefes',
		displayKey: 'codigo',
		templates: {
			empty: [
				'<div class="empty-message">',
				'La busqueda no arrojó ningún resultado',
				'</div>'
			].join('\n'),
			suggestion: Handlebars.compile('<p><strong>{{nombre}}</strong></p>')
		},
		source: jefes.ttAdapter()
		});

	});
</script>
<div class="row">
	<div id="ajaxLoadAni" class="col-md-2 col-md-offset-5">
		<img src="<?=$ruta_tema?>/img/ajax-loader.gif" alt="Ajax Loading Animation" />
	</div>
</div>
	
<div id="notificaciones" class="col-lg-12"></div>


<!-- Inicio modal crear cargo-->	
 <div class="modal fade " id="modal-crear-cargo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-primary">
			<div class="modal-header modal-heading">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Crear nuevo cargo</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form role="form" method="post" action="personal/gestion_cargos/insertar" id="formulario-crear-cargo">
						<div class="form-group col-lg-6">
							<label>Primera edición</label>
							<input class="form-control" placeholder="Fecha" name="primera_edicion" data-provide="datepicker">
							<label>Actualizado al</label>
							<input class="form-control" placeholder="Fecha" name="actualizacion" data-provide="datepicker">
							<label>Código</label>
							<input class="form-control" placeholder="Código" name="codigo_ipsa">
							<label>Nombre del cargo</label>
							<input class="form-control" placeholder="nombre" name="nombre" title="Ingrese el nombre del cargo">
							<label>Nombre del cargo del jefe inmediato</label>
							<div id="remote">
								<input type="text" class=" typeahead form-control" placeholder="Escriba aquí para buscar el código del artículo" name="jefe">
							</div>
							<label>Edición</label>
							<input class="form-control" placeholder="Edición" name="edicion" title="Edición del documento">
						</div>
						<div class="form-group col-lg-6">
							<label>vicepresidencia</label>
							<input class="form-control" placeholder="vicepresidencia" name="vicepresidencia" title="vicepresidencia a la que pertenece">
							<label>Gerencia</label>
							<input class="form-control" placeholder="gerencia" name="gerencia" title="presidencia a la que pertenece">
							<label>Dirección</label>
							<input class="form-control" placeholder="direccion" name="direccion" title="direccion a la que pertenece">
							<label>Departamento</label>
							<input class="form-control" placeholder="departamento" name="departamento" title="departamento a la que pertenece">
							<label>Sección</label>
							<input class="form-control" placeholder="seccion" name="seccion" title="seccion a la que pertenece">
						</div>
						<div class="form-group col-lg-12">
							<label>Misión</label>
							<textarea class="form-control" placeholder="Mision" name="mision"></textarea>
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
<!-- Fin modal crear-cargo -->





<!-- Inicio modal eliminar cargo-->	
<div class="modal fade " id="modal-eliminar-cargo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-danger">
			<div class="modal-header modal-heading">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Eliminar cargo</h4>
			</div>
				<div class="modal-body">
				<div class="row">
					<p class="text-center">¿Está seguro de eliminar el cargo: <strong id="nombre-cargo-eliminar" class="text-danger"></strong> ?<p>
					<form role="form" method="post" action="personal/gestion_cargos/eliminar" id="formulario-eliminar-cargo">
						<input type="hidden" id="codigo-cargo-eliminar" name="codigo" value=""/>
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
<!-- Fin modal eliminar cargo -->

<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div>Lista de cargos 
				<button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#modal-crear-cargo">Nuevo </button>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<div class="table-responsive">
				<table id="tabla-cargos" class="table table-striped table-bordered table-hover">
					<thead class="active">
						<th class="header">Código</th>
						<th class="header">Cargo</th>
						<th class="header">Dirección</th>
						<th class="header">Departamento</th>
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