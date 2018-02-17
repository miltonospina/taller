<script type="text/javascript">
	$(document).ready(function() 
	{
		$(document).ready(function() {
			$('#example').DataTable( {
				
				 ajax: {
					url: "personal/gestion_cargos/detalle/<?=$cargo->codigo?>",
					dataSrc: 'funciones.planificar'
				},
				columns: [{ "data": "[]" }]
			
			} );
		} );	
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
			<div>Detalle del cargo
			<a href="personal/gestion_cargos"type="button" class="btn btn-default pull-right btn-sm"><i class='fa fa-arrow-left'></i> Regresar </a>
				<div class="clearfix"></div>
			</div>
		</div>
		<!-- /.panel-heading -->
		<div class="panel-body">
			<div class="row show-grid">
				<div class="col-md-6">
					<b>Primera edición:</b> <?=$cargo->primera_edicion?>
				</div>
				<div class="col-md-6">
					<b>Código:</b> <?=$cargo->codigo_ipsa?>
				</div>
			</div>
			<div class="row show-grid">
				<div class="col-md-12">
					<b>Nombre del cargo:</b> <?=$cargo->nombre?>
				</div>
			</div>
			<div class="row show-grid">
				<div class="col-md-12">
					<div><b>Línea de dependencia</b></div>
					<div><b>Vicepresidencia:</b> <?=$cargo->dependencia->vicepresidencia?></div>
					<div><b>Gerencia:</b> <?=$cargo->dependencia->gerencia?></div>
					<div><b>Dirección:</b> <?=$cargo->dependencia->direccion?></div>
					<div><b>Departamento:</b> <?=$cargo->dependencia->departamento?></div>
					<div><b>Sección:</b> <?=$cargo->dependencia->seccion?></div>
				</div>
			</div>
			<div class="row show-grid">
				<div class="col-md-12">
					<b>Nombre del cargo del jefe inmediato:</b> <?=$cargo->jefe->nombre?>
				</div>
			</div>
			<div class="row show-grid">
				<div class="col-md-12">
				<b>1. Misión</b>
				<p><?=$cargo->mision?></p>
				</div>
			</div>
			<div class="row show-grid">
				<div class="col-md-12">
				<b>Análisis del cargo</b>
				<b>Funciones del gargo</b>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Funciones de Planificar
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<table width="100%" class="table table-striped table-bordered table-hover" id="example" >
							<thead>
								<tr>
									<th>Descripción</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>Descripción</th>
								</tr>
							</tfoot>
						</table>
						</div>
				</div>
			</div>
		</div>
</div>
<div id="notificaciones" class="col-lg-12"></div>
<p style="margin-bottom: 6px; text-align: center;"> ... </p>