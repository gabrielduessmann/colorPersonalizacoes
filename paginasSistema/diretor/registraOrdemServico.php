<?php

  
    session_start();

        if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



    require_once("../conexaoBanco.php");
    

    $codigoOrcamento = $_POST['codigoOrcamento'];
    $dataEntrega = $_POST['dataEntrega'];
    $customizador = $_POST['customizador'];
    $status=1;

    if ($customizador == 0) {
        $customizador = $_SESSION['idLogado'];
    } else {
        $status=2;
    }

    $comando = "INSERT INTO ordensservicos VALUES (NULL, ".$status.", '".date('Y-m-d')."', '".$dataEntrega."', ".$codigoOrcamento.",
    ".$customizador.")";
    // echo $comando;
    
    $resultado = mysqli_query($conexao, $comando);

    $comando2 = "UPDATE orcamentos SET status=3 WHERE codigo=".$codigoOrcamento;
    // echo $comando2;
    $resultado2 = mysqli_query($conexao, $comando2);

    if($resultado == true && $resultado2 == true){
		header("Location: registroOrdemServicoForm.php?retorno=ok");
	} else{
		header("Location: registroOrdemServicoForm.php?retorno=Nok");
	}



  }else {
    header("Location: ../../paginasSite/entrar.php");
  }
 ?>