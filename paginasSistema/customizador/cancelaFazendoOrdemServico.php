<?php


session_start();

  if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==2) {



    require_once("../conexaoBanco.php");

    $codigoOrdemServico = $_POST['codigoOrdemServico'];

    $comando = "UPDATE ordensservicos SET status=1 WHERE codigo=".$codigoOrdemServico;
    $resultado = mysqli_query($conexao, $comando);

    header("Location: editaOrdemServicoForm.php");


  }else {
    header("Location: ../../paginasSite/entrar.php");
  }
  
 ?>
