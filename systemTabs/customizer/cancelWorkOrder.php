<?php


session_start();

  if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==2) {



    require_once("../dbConnection.php");

    $codigoOrdemServico = $_POST['codigoOrdemServico'];

    $comando = "UPDATE ordensservicos SET status=1 WHERE codigo=".$codigoOrdemServico;
    $resultado = mysqli_query($conexao, $comando);

    header("Location: workOrderEditionForm.php");


  }else {
    header("Location: ../../websiteTabs/login.php");
  }
  
 ?>
