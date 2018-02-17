<!DOCTYPE html>
<html>
  <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <base href="<?=base_url(); ?>" />
      <title><?=$titulo?></title>
      <!-- Core CSS - Include with every page -->
      <link href="data:image/x-icon;base64,AAABAAEAEBAAAAAAAABoBQAAFgAAACgAAAAQAAAAIAAAAAEACAAAAAAAAAEAAAAAAAAAAAAAAAEAAAAAAADr6+sAAAAAAKB9bQDW1tYAx8jIAMjIyADw8PAAoH1uAO/v7wB4SDYA1NTUAOjo6AB/hIIA2draAO7u7gDFxcUA2dnZAO3t7QDz8/MA7OzsANGtnQDR0dEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAQwMDAwMDAwMDAwMDAwMAQwQEBAQEBAQEBAQEBAQEAwBDBIGFRMAAAAABQ8PCwwBAQEMDAwMDAwMDAwMDAwBAQEMAxEREREREREREREKDAEBDBIJCQkJCQkJCQkJEQwBAQwRCQICAgICAgICCREMAQEMDgkCFBQUFBQUAgkODAEBDA4JAhQUFBQUFAIJDgwBAQwOCQIUFBQUFBQCCQgMAQEMBgkCFBQUFBQUAgkGDAEBDBIJAgICAgICBwIJBgwBAQwRCQkJCQkJCQkJCQYMAQEMBBERERERERERERENDAEBAQwMDAwMDAwMDAwMDAEBAQEBAQEBAQEBAQEBAQEBAYABAAAAAAAAgAEAAMADAACAAQAAgAEAAIABAACAAQAAgAEAAIABAACAAQAAgAEAAIABAACAAQAAwAMAAP//AAA=" rel="icon" type="image/x-icon" />
      <link href="<?=base_url()?>application/views/app/sb-admin-v2/css/bootstrap.min.css" rel="stylesheet">
      <link href="<?=base_url()?>application/views/app/sb-admin-v2/font-awesome/css/font-awesome.css" rel="stylesheet">
      <link href="<?=base_url()?>application/views/app/sb-admin-v2/css/jquery-ui.min.css" rel="stylesheet">
        <!-- Page-Level Plugin CSS - Blank -->

        <!-- SB Admin CSS - Include with every page -->
      <link href="<?=base_url()?>application/views/app/sb-admin-v2/css/sb-admin.css" rel="stylesheet">
      <script type="text/javascript" src="<?=base_url()?>application/views/app/sb-admin-v2/js/jquery.min.js"></script>
      <script type="text/javascript" src="<?=base_url()?>application/views/app/sb-admin-v2/js/angular.min.js"></script>
<?=$scripts?>
  </head>
  <body>
      <div id="wrapper">
        <?=$header?>
        <?=$content?>
      </div>
      <!-- /#wrapper -->
      <?=$footer?>
  </body>
</html>