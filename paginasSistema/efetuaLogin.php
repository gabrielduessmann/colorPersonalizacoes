<?php

require_once("conexaoBanco.php");


$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$senha=md5($senha);

// echo $usuario."    ".$senha;

$comando = "SELECT * FROM usuarios WHERE
usuario='".$usuario."' AND senha='".$senha."'";

// echo $comando;
$resultado=mysqli_query($conexao, $comando);
$user = mysqli_fetch_assoc($resultado);
$linhas=mysqli_num_rows($resultado);

if ($linhas==0) {
  header("Location: ../paginasSite/entrar.php");
}else{
  session_start();
  $_SESSION['idLogado'] = $user['id'];
  $_SESSION['usuarioLogado'] = $user['usuario'];
  $_SESSION['nivelLogado'] = $user['graupermissao'];

  if($_SESSION['nivelLogado']==1){
    header("Location: diretor/principal.php");
  }else if($_SESSION['nivelLogado']==2){
    header("Location: customizador/principal.php");
  }else {
    header("Location: atendente/principal.php");
  }
}

 ?>
