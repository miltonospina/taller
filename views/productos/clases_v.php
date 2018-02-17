<script type="text/javascript" src="<?=base_url()?>application/views/app/sb-admin-v2/js/jquery-dataui.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{


		//cargar la tabla con los datos
		$("#tabla-clases").tablaAjax({
			urldatos: "productos/gestion_clases/lista",
			fuente:"json",
			animacion: "#ajaxLoadAni",
			columnas: Array(
				"<td>{codigo}</td>",
				"<td>{nombre}</td>",
				"<td class='action col-md-2'><div class='text-center'>"+
				"<a href='productos/gestion_clases/ver_detalle/{codigo}' class='edit btn btn-outline btn-info btn-sm' ><i class='fa fa-eye'/></a> "+
				"<a href='#modal-eliminar-clase' class='edit btn btn-outline btn-warning btn-sm' data-toggle='modal' data-target='#modal-editar-clase' data-codigo='{codigo}' data-nombre='{nombre}'><i class='fa fa-pencil'/></a> "+
				"<a href='#modal-eliminar-clase' class='delete btn btn-outline btn-danger btn-sm' data-toggle='modal' data-target='#modal-eliminar-clase' data-codigo='{codigo}' data-nombre='{nombre}'><i class='fa fa-trash-o'/></a> "+
				"</div></td>"
				)
		});



		$("#boton-crear").click(function() {
			$("#modal-crear-clase").enviarModalAjax({
				animacion: "#ajaxLoadAni",
				divNotificaciones:"#notificaciones",
				funcionActualizar:'$("#tabla-clases").tablaAjax();'
			});
		});






	//Accion enlaces eliminar
		$(document).on("click", ".delete", function () {
			$('#codigo-clase-eliminar').val( $(this).data('codigo'));
			$('#nombre-clase-eliminar').html( $(this).data('nombre'));
		});



	// Funcion confirmar eliminar
		$("#boton-eliminar").click(function() {
			$("#modal-eliminar-clase").enviarModalAjax({
				animacion: "#ajaxLoadAni",
				divNotificaciones:"#notificaciones",
				funcionActualizar:'$("#tabla-clases").tablaAjax();'
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


<!-- Inicio modal crear clase-->
 <div class="modal fade " id="modal-crear-clase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-primary">
			<div class="modal-header modal-heading">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Crear nueva clase</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form role="form" method="post" action="productos/gestion_clases/insertar" id="formulario-crear-clase">
						<div class="form-group col-lg-6">
							<label>Nombre de la clase de producto</label>
							<input class="form-control" placeholder="Nombre de la clase de producto" name="nombre">
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
<!-- Fin modal crear-clase -->





<!-- Inicio modal eliminar clase-->
<div class="modal fade " id="modal-eliminar-clase" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-danger">
			<div class="modal-header modal-heading">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Eliminar clase</h4>
			</div>
				<div class="modal-body">
				<div class="row">
					<p class="text-center">¿Está seguro de eliminar la clase: <strong id="nombre-clase-eliminar" class="text-danger"></strong> ?<p>
					<form role="form" method="post" action="productos/gestion_clases/eliminar" id="formulario-eliminar-clase">
						<input type="hidden" id="codigo-clase-eliminar" name="codigo" value=""/>
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
<!-- Fin modal eliminar clase -->

<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div>Lista de clases
				<button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#modal-crear-clase">Nuevo </button>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<div class="table-responsive">
				<table id="tabla-clases" class="table table-striped table-bordered table-hover">
					<thead class="active">
						<th class="header">Código</th>
						<th class="header">clase</th>
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
