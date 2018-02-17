<nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#">Energy+</a>
    </div>
    <!-- /.navbar-header -->

    <ul class="nav navbar-top-links navbar-right">
          <li><a href="<?=base_url();?>ayuda#<?=$this->router->fetch_class()?>" title="Ayuda para esta función"><i class="fa fa-question-circle fa-fw"></i></a></li>
          <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i></a>
            <ul class="dropdown-menu dropdown-user">
                <li><p><i class="fa fa-user fa-fw"></i> <b><?=$usuario->username?></b></p><p><?=$usuario->nombre?></p></li>
                <li class="divider"></li>
                <li><a href="<?=base_url();?>admin/gestion_usuarios/form_cambiar_contrasena/<?=$usuario->codigo?>" title="Cerrar sesión de <?=$usuario->nombre?>"><i class="fa fa-key fa-fw"></i>Cambiar contraseña</a></li>
                <li><a href="<?=base_url();?>inicio/salir" title="Cerrar sesión de <?=$usuario->nombre?>"><i class="fa fa-sign-out fa-fw"></i>Salir</a></li>
            </ul>
              <!-- /.dropdown-user -->
          </li>
        <!-- /.dropdown -->
    </ul>
    <!-- /.navbar-top-links -->
</nav>
        <!-- /.navbar-static-top -->
		<nav class="navbar-default navbar-static-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Buscar...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
					<?php echo(arrayToUL($jerarquia,$codigopadre));?>
                </ul>
                <!-- /#side-menu -->
            </div>
            <!-- /.sidebar-collapse -->
        </nav>
        <!-- /.navbar-static-side -->
