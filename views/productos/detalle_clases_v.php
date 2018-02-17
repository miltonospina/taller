<script type="text/javascript" src="<?=base_url()?>application/views/app/sb-admin-v2/js/jquery-dataui.js"></script>
<script type="text/javascript">
	$(document).ready(function()
	{


		//cargar la tabla con los datos
		$("#tabla-atributos").tablaAjax({
			urldatos: "productos/gestion_clases/detalle/<?=$clase->codigo?>",
			fuente:"json",
			animacion: "#ajaxLoadAni",
			tipodatos:"obj",
			columnas: Array(
				"<td>{clave}</td>",
				"<td>{valor}</td>",
				"<td class='action col-md-2'><div class='text-center'>"+
				"<a href='productos/gestion_clases/ver_detalle/{codigo}' class='edit btn btn-outline btn-info btn-sm' ><i class='fa fa-eye'/></a> "+
				"<a href='#modal-editar-clase' class='edit btn btn-outline btn-warning btn-sm' data-toggle='modal' data-target='#modal-editar-clase' data-codigo='{codigo}' data-nombre='{nombre}'><i class='fa fa-pencil'/></a> "+
				"<a href='#modal-eliminar-clase' class='delete btn btn-outline btn-danger btn-sm' data-toggle='modal' data-target='#modal-eliminar-clase' data-codigo='{codigo}' data-nombre='{nombre}'><i class='fa fa-trash-o'/></a> "+
				"</div></td>"
				)
		});


		$("#boton-crear").click(function() {
			$("#modal-crear-attr").enviarModalAjax({
				animacion: "#ajaxLoadAni",
				divNotificaciones:"#notificaciones",
				funcionActualizar:'$("#tabla-atributos").tablaAjax();'
			});
		});

	});
</script>
<div class="row">
	<div id="ajaxLoadAni" class="col-md-2 col-md-offset-5">
		<img src="<?=$ruta_tema?>/img/ajax-loader.gif" alt="Ajax Loading Animation" />
	</div>
</div>
<div class="col-lg-12">
	<div class="panel panel-default">
		<div class="panel-heading">
			<div>Detalle de la clase de producto
			<a href="productos/gestion_clases" type="button" class="btn btn-default pull-right btn-sm"><i class='fa fa-arrow-left'></i> Regresar </a>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<div class="row show-grid">
				<div class="col-md-12">
					<b>Código:</b> <?=$clase->codigo?>
				</div>
				<div class="col-md-12">
					<b>Nombre:</b> <?=$clase->nombre?>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Atriburos de la clase
						<button type="button" class="btn btn-primary pull-right btn-sm" data-toggle="modal" data-target="#modal-crear-attr">Nuevo </button>
						<div class="clearfix"></div>
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="table-responsive">
							<table id="tabla-atributos" class="table table-striped table-bordered table-hover">
								<thead class="active">
									<th class="header">atributo</th>
									<th class="header">Valor inicial</th>
									<th class="header">Acciones</th>
								</thead>
								<tbody>
								</tbody>
							</table>
						</div>
				</div>
			</div>
		</div>
</div>
<div id="notificaciones" class="col-lg-12"></div>



<!-- Inicio modal crear atributo-->
 <div class="modal fade " id="modal-crear-attr" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content modal-primary">
			<div class="modal-header modal-heading">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<h4 class="modal-title" id="myModalLabel">Crear nuevo atributo</h4>
			</div>
			<div class="modal-body">
				<div class="row">
					<form role="form" method="post" action="productos/gestion_clases/agregar_atributo" id="formulario-agregar-atributo">
						<div class="form-group col-lg-6">
							<label>Nombre del atributo</label>
							<input class="form-control" placeholder="Nombre del atributo" name="clave"/>
						</div>
						<div class="form-group col-lg-6">
							<label>Valor inicial</label>
							<input class="form-control" placeholder="Valor inicial del atributo" name="valor"/>
							<input type="hidden" name="clase" value="<?=$clase->codigo?>" />
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
<!-- Fin modal crear-atributo -->



<p style="margin-bottom: 6px; text-align: center;"> ... </p>
