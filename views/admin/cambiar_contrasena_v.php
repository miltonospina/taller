<div class="row">
	<div id="ajaxLoadAni" class="col-md-2 col-md-offset-5">
		<img src="<?=$ruta_tema?>/img/ajax-loader.gif" alt="Ajax Loading Animation" />
	</div>
</div>
	
<div id="notificaciones" class="col-lg-8"></div>
	<div class="col-md-offset-2 colmd-6">
		<div class="panel panel-primary">
			<div class="panel-heading">
			 Cambiar contraseña
			</div>
<form role="form" method="post" action="admin/gestion_usuarios/cambiar_contrasena" id="cambiar-contrasena">
		<div class="panel-body">
					<input type="hidden" name="codigo" value="<?=$usuario->codigo?>"/>
					<div class="form-group col-lg-6">
						<label>Usuario del sistema</label>
						<input class="form-control" placeholder="Usuario" name="username" disabled value="<?=$usuario->username?>"/>
						<label>Contraseña actual</label>
						<input class="form-control" placeholder="Ingrese contraseña actual" type="password" name="password0" title="Combíne letras y numeros">
						<label>Nueva contraseña</label>
						<input class="form-control" placeholder="Digite nueva contraseña - Combíne letras y numeros" name="password1">
						<label>Confirme nueva contrasena</label>
						<input class="form-control" placeholder="Confirme nueva contraseña" name="password2">
					</div>			
			</div>
			<div class="panel-footer">
			<button type="button" class="btn btn-default">Cancelar</button>
			<button type="submit" class="btn btn-success" id="boton-grabar">Grabar</button>
			</div>
</form>
		</div>
	</div>
