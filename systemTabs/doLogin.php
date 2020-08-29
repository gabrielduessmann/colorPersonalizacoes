<?php

require_once("dbConnection.php");


$usuario = $_POST['usuario'];
$senha = $_POST['senha'];

$senha=md5($senha);

$comando = "SELECT * FROM usuarios WHERE
usuario='".$usuario."' AND senha='".$senha."'";


$resultado=mysqli_query($conexao, $comando);
$user = mysqli_fetch_assoc($resultado);
$linhas=mysqli_num_rows($resultado);

if ($linhas==0) {
  header("Location: ../websiteTabs/login.php");
}else{
  session_start();
  $_SESSION['idLogado'] = $user['id'];
  $_SESSION['usuarioLogado'] = $user['usuario'];
  $_SESSION['nivelLogado'] = $user['graupermissao'];

  if($_SESSION['nivelLogado']==1){
    header("Location: manager/home.php");
  }else if($_SESSION['nivelLogado']==2){
    header("Location: customizer/home.php");
  }else {
    header("Location: attendant/home.php");
  }
}

 ?>
