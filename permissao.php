<?php
if(!isset($_SESSION))
{
    session_start();
} 

  if(!isset($_SESSION['nome'])){
    header("location: ../login.php?msg=Favor efetue o Login!");
    exit();
  }
 ?>
