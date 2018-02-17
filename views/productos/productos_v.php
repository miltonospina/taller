<script type="text/javascript" src="<?=base_url()?>application/views/app/sb-admin-v2/js/jquery-dataui.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{


		//cargar la tabla con los datos
		$("#tabla-productos").tablaAjax({
			urldatos: "productos/gestion_productos/lista",
			fuente:"json",
			animacion: "#ajaxLoadAni",
			columnas: Array(
				"<td>{codigo}</td>",
				"<td>{nombre}</td>",
				"<td class='action col-md-2'><div class='text-center'>"+
				"<a href='productos/gestion_productos/ver_detalle/{codigo}' class='edit btn btn-outline btn-info btn-sm' ><i class='fa fa-eye'/></a> "+
				"<a href='#modal-eliminar-producto' class='edit btn btn-outline btn-warning btn-sm' data-toggle='modal' data-target='#modal-editar-producto' data-codigo='{codigo}' data-nombre='{nombre}'><i class='fa fa-pencil'/></a> "+
				"<a href='#modal-editar-producto' class='delete btn btn-outline btn-danger btn-sm' data-toggle='modal' data-target='#modal-editar-producto' data-codigo='{codigo}' data-nombre='{nombre}'><i class='fa fa-trash-o'/></a> "+
				"</div></td>"
				)
		});



		$("#boton-crear").click(function() {
			$("#modal-crear-producto").enviarModalAjax({
				animacion: "#ajaxLoadAni",
				divNotificaciones:"#notificaciones",
				funcionActualizar:'$("#tabla-productos").tablaAjax();'
			});
		});






	//Accion enlaces eliminar
		$(document).on("click", ".delete", function () {
			$('#codigo-producto-eliminar').val( $(this).data('codigo'));
			$('#nombre-producto-eliminar').html( $(this).data('nombre'));
		});



	// Funcion confirmar eliminar
		$("#boton-eliminar").click(function() {
			$("#modal-eliminar-producto").enviarModalAjax({
				animacion: "#ajaxLoadAni",
				divNotificaciones:"#notificaciones",
				funcionActualizar:'$("#tabla-productos").tablaAjax();'
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


<!-- Inicio modal crear producto-->
 <div class="modal fade " id="modal-crear-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-primary">
			<div class="modal-header modal-heading">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Crear nueva producto</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form role="form" method="post" action="productos/gestion_productos/insertar" id="formulario-crear-producto">
						<div class="form-group col-lg-6">
							<label>Nombre de la producto de producto</label>
							<input class="form-control" placeholder="Nombre de la producto de producto" name="nombre">
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
<!-- Fin modal crear-producto -->





<!-- Inicio modal eliminar producto-->
<div class="modal fade " id="modal-eliminar-producto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-danger">
			<div class="modal-header modal-heading">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Eliminar producto</h4>
			</div>
				<div class="modal-body">
				<div class="row">
					<p class="text-center">¿Está seguro de eliminar la producto: <strong id="nombre-producto-eliminar" class="text-danger"></strong> ?<p>
					<form role="form" method="post" action="productos/gestion_productos/eliminar" id="formulario-eliminar-producto">
						<input type="hidden" id="codigo-producto-eliminar" name="codigo" value=""/>
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
<!-- Fin modal eliminar producto -->

<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div>Lista de productos
				<button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#modal-crear-producto">Nuevo </button>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<div class="table-responsive">
				<table id="tabla-productos" class="table table-striped table-bordered table-hover">
					<thead class="active">
						<th class="header">Código</th>
						<th class="header">producto</th>
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
