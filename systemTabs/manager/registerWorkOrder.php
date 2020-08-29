<?php

  
    session_start();

        if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



    require_once("../dbCoonection.php");
    

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
        
    $resultado = mysqli_query($conexao, $comando);

    $comando2 = "UPDATE orcamentos SET status=3 WHERE codigo=".$codigoOrcamento;
    $resultado2 = mysqli_query($conexao, $comando2);

    if($resultado == true && $resultado2 == true){
		header("Location: workOrderRegistrationForm.php?retorno=ok");
	} else{
		header("Location: workOrderRegistrationForm.php?retorno=Nok");
	}



  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>