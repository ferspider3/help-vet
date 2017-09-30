<?php
  include('permissao.php');
 ?>
<?php include('conexao.php');
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $senha = $_POST['senha'];
  $nivel = $_POST['nivel'];
  $foto = "user.png";

  $senha = md5($senha);
  $comando = "insert into usuario (nome, email, senha, nivel, foto)
              values ('$nome', '$email', '$senha', '$nivel', '$foto')";

  $sucesso = mysqli_query($link, $comando) or exit(mysqli_error($link));

  if ($sucesso) {
    $mensagem = "Usuário Cadastrado com sucesso!";
  }else{
    $mensagem = "Falha ao Cadastrar Usuário!";
  }

  header("location: usuario.php?msg=$mensagem")
 ?>
