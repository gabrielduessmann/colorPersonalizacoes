<?php
  require_once("../paginasSistema/conexaoBanco.php");
  session_start();

  $usuario = $_POST['usuario'];
  $_SESSION['usuario'] = $usuario;
  $testadora = 0;

  if ($usuario=="") {
    $testadora = 1;
  }else{
    $comando = "SELECT usuario FROM usuarios WHERE usuario='".$usuario."'";
    $resultado = mysqli_query($conexao, $comando);
    $linhas = mysqli_num_rows($resultado);

    if ($linhas != 0) {
      $testadora = 1;
    }else {
      $testadora = 0;
    }
  }

  echo $testadora;





 ?>
