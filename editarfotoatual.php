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
  <title>HelpVet | Editar Usuário</title>
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
  <link rel="stylesheet" href="css/jcrop.min.css">

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
        Editar Usuário
        <small>Editar Foto</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-picture-o" aria-hidden="true"></i> Editar Usuário</a></li>
        <li class="active">Editar Foto</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Editar Foto</h3>
            </div>
            <!-- form start -->
            <?php if($_SESSION['nivel'] == 'Administrador'|| $_SESSION['idusuario'] == $usuario['idusuario']){ ?>
              <div class="box-body">
                <div class="col-md-8">
                  <?php
                    if($_SERVER['REQUEST_METHOD'] == 'POST'){
                      if(isset($_POST['w'])){
                        $x = (int)$_POST['x'];
                        $y = (int)$_POST['y'];
                        $w = (int)$_POST['w'];
                        $h = (int)$_POST['h'];
                        $img = $_POST['img'];

                        include_once "funcao.php";
                        $crop = crop($img, $x, $y, $w, $h);
                        if($crop){
                          if($_SESSION['temp_img'] != ''){
                            $link->query("UPDATE `usuario` SET `foto` = '".$crop."' WHERE `idusuario` = ".$idusuario);
                            //$upd_foto->bind_param('si', $crop, $Idmembro);
                            if($link->affected_rows > 0){
                              echo '<div class="alert alert-success">Imagem cortada e Salva com sucesso!</div>';
                            }
                            //$upd_foto->close();
                          }else{
                            $link->query("UPDATE `usuario` SET `foto` = '".$crop."' WHERE `idusuario` = ".$idusuario);

                            if($link->affected_rows > 0){
                              echo '<div class="alert alert-success">Imagem cortada e Salva com sucesso!</div>';
                            }
                            //$upd_foto->close();
                          }
                          unlink("uploads/".$_SESSION['temp_img']);
                          unset($_SESSION['temp_img']);
                        }else{
                          echo '<div class="alert alert-danger">Não foi possível Cortar a Foto!</div>';
                          unlink('uploads/'.$_SESSION['temp_img']);
                          unset($_SESSION['temp_img']);
                        }
                      }elseif(isset($_POST['upl_foto'])){
                        include_once "lib/WideImage.php";
                        $tamanhos = getimagesize($_FILES['foto']['tmp_name']);
                        if($tamanhos[0] < 500){
                          echo '<div class="alert alert-info">A imagem precisa ter no mínimo 500px de largura!</div>';
                        }else{
                          $wide = WideImage::load($_FILES['foto']['tmp_name']);
                          $resized = $wide->resize(500);
                          $temp_name_image = md5(uniqid(rand(), true));
                          $resize = $resized->saveToFile("uploads/".$temp_name_image.".jpg");
                          if(is_object($resized)){
                            $_SESSION['temp_img'] = $temp_name_image.'.jpg';
                          }
                        }
                      }
                    }
                  ?>

                  <?php if(isset($_SESSION['temp_img'])):?>
                  <div class="img_crop jcrop-active">
                    <img src="uploads/<?php echo $_SESSION['temp_img'] ?>"  id="target" />
                  </div>

                  <form class="form-group" action="" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="x" name="x" value="0" class="coord"/>
                    <input type="hidden" id="y" name="y" value="0" class="coord"/>
                    <input type="hidden" id="w" name="w" value="160" class="coord" />
                    <input type="hidden" id="h" name="h" value="160" class="coord"/>
                    <input type="hidden" name="img" value="uploads/<?php echo $_SESSION['temp_img'];?>"/>
                    <br>
                    <input class="btn btn-success" type="submit" name="crop" value="Cortar Imagem" class="button" />
                  </form>
                  <?php else:?>
                    <form class="form-group box-footer" action="" method="post" enctype="multipart/form-data">
                      <input type="file" class="form-control" name="foto" />
                      <br>
                      <input type="submit" class="btn btn-primary" name="upl_foto" value="Enviar Foto" />
                      <a href="editarconta.php?id=<?php print $usuario['idusuario']; ?>" class="btn btn-warning">Voltar</a>
                    </form>
                  <?php endif;?>
                </div>
              </div>
              <br>
              <br>
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
<script src="js/jcrop.min.js"></script>
<script>
  $(document).ready(function(){
    $('#Modal').modal('show');
  });
</script>
<script>
$('#target').Jcrop({
  aspectRatio: 1,
  minSize: [255,255],
  setSelect: [0,0,255,255],
  onChange: showCoords,
  onSelect: showCoords,
});
function showCoords(c){
  $('#x').val(c.x);
  $('#y').val(c.y);
  $('#w').val(c.w);
  $('#h').val(c.h);
};
</script>
<script>
  setTimeout(function(){
    $('.alert').fadeOut();
  }, 2000);
</script>
</body>
</html>
