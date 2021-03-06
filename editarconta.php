<?php
  include('permissao.php');
 ?>
<?php
  $idusuario = $_GET['id'];
  include('conexao.php');

  $comando = "select * from usuario where idusuario = $idusuario";
  $resultado = mysqli_query($link, $comando);

  $usuario = mysqli_fetch_array($resultado);
 ?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>HelpVet | Editar Conta</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="bower_components/morris.js/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="bower_components/jvectormap/jquery-jvectormap.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">

  <link rel="shortcut icon" href="favicon.png">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition skin-green-light sidebar-mini">
<div class="wrapper">

  <?php include ('_menusuperior.php') ?>
  <!-- Left side column. contains the logo and sidebar -->
  <?php include ('_menulateral.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrativo
        <small>Editar Conta</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-users" aria-hidden="true"></i> Administrativo</a></li>
        <li class="active">Editar Conta</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Conta</h3>
            </div>
            <!-- form start -->
            <?php if($_SESSION['nivel'] == 'Administrador'|| $_SESSION['idusuario'] == $usuario['idusuario']){ ?>
            <form role="form" action="atualizausuario1.php" method="post">
              <div class="box-body">
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="codigo">Código: </label>
                    <input type="text" class="form-control" id="codigo" name="codigo" readonly value="<?php print $usuario['idusuario']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="nome">Nome: </label>
                    <input type="text" class="form-control" id="nome" name="nome" required value="<?php print $usuario['nome']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" class="form-control" id="email" name="email" required value="<?php print $usuario['email']; ?>">
                  </div>
                  <div class="form-group">
                    <label for="senha">Senha: </label>
                    <input type="password" class="form-control" id="senha" name="senha" placeholder="Inalterada">
                  </div>
                  <div class="form-group">
                    <label for="senha">Foto Atual: </label>
                    <br>
                    <img class="img-circle" src="imagens/<?php print $usuario['foto']; ?>" width="30%">
                  </div>
                  <div class="form-group">
                    <a class="btn btn-success col-md-3" href="editarfotoatual.php?id=<?php print $usuario['idusuario']; ?>"><i class="fa fa-picture-o" aria-hidden="true"></i> Editar Foto</a>
                  </div>
                </div>
              </div>
              <br>
              <br>
              <!-- /.box-body -->
              <div class="box-footer">
                <a href="index.php" class="btn btn-danger col-md-offset-1 col-md-2"><i class="fa fa-ban" aria-hidden="true"></i> Cancelar</a>
                <button type="submit" class="btn btn-primary col-md-offset-1 col-md-2"><i class="fa fa-floppy-o" aria-hidden="true"></i> Salvar</button>
              </div>
            </form>
            <?php } ?>
          </div>
        </div>
      </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <?php include ('_rodape.php') ?>

  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<!-- Sparkline -->
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
