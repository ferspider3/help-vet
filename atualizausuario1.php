<?php
  include('conexao.php');
  include('permissao.php');
  //Capturar os dados SQL
  $idusuario = $_POST['codigo'];
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];

  if(empty($senha)){
    $comando = "update usuario set nome = '$nome', email = '$email'
                where idusuario = $idusuario";
  }else{
    $senha = md5($senha);
    $comando = "update usuario set nome = '$nome', email = '$email', senha = '$senha'
                where idusuario = $idusuario";
  }
  //monta o comando SQL


  //Executa o comando SQL
  $ok = mysqli_query($link, $comando);

  if($ok){
    $mensagem = "Pefil Alterado!";
  }else{
    $mensagem = "Uma Falha ocorreu, tente novamente!";
  }

  header("location:index.php?msg=$mensagem");
 ?>
