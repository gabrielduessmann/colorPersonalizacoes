<?php

  
  session_start();

    if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



    require_once("../dbConnection.php");

    $codigoOrcamento = $_POST['codigoOrcamento'];

    $comando = "UPDATE orcamentos SET status=2 WHERE codigo=".$codigoOrcamento;
    $resultado = mysqli_query($conexao, $comando);

    header("Location: workOrderRegistrationForm.php");

    
    
}else {
  header("Location: ../../websiteTabs/login.php");
}
?>