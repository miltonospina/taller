<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar al sistema</title>
    <!-- Core CSS - Include with every page -->
    <link href="<?=base_url()?>application/views/app/sb-admin-v2/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=base_url()?>application/views/app/sb-admin-v2/font-awesome/css/font-awesome.css" rel="stylesheet">
    <!-- SB Admin CSS - Include with every page -->
    <link href="<?=base_url()?>application/views/app/sb-admin-v2/css/sb-admin.css" rel="stylesheet">

	<script src="<?=base_url()?>application/views/app/sb-admin-v2/js/jquery.min.js"></script>
	<script src="<?=base_url()?>application/views/app/sb-admin-v2/js/jquery.validate.js" type="text/javascript"></script>
	<script src="<?=base_url()?>application/views/app/sb-admin-v2/js/jquery.md5.js" type="text/javascript"></script>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Ingresar al sistema</h3>

                    </div>
                    <div class="panel-body">
                        <form role="form" action="<?=base_url().$this->router->directory.$this->router->fetch_class()?>/ingresar" id="loginform" method="post">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Usuario" name="username" id="cusername" type="text" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contraseña" name="password" id="cpassword" type="password" value="">
                                </div>
								<input type="hidden" name="sal" value="<?=$sal?>"/>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="submit" class="btn btn-lg btn-success btn-block" value="Ingresar"/>
                            </fieldset>
                        </form>
						<?=$msg?>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$("#loginform").validate();

			$("#loginform").submit(function (){
					temp=$.md5($("#cpassword").val());
					temp=$.md5(temp+$("#loginform input[name=sal]").val());
					$("#cpassword").val(temp);
			});
		});
	</script>
    <!-- Core Scripts - Include with every page -->
    <script src="<?=base_url()?>application/views/app/sb-admin-v2/js/bootstrap.min.js"></script>
    <script src="<?=base_url()?>application/views/app/sb-admin-v2/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <!-- SB Admin Scripts - Include with every page -->
    <script src="<?=base_url()?>application/views/app/sb-admin-v2/js/sb-admin.js"></script>
</body>
</html>
