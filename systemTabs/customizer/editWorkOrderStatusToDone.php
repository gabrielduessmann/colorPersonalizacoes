<?php


	session_start();

		if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==2) {



    $codigoOrdemServico = $_POST['codigoOrdemServico'];
    // echo $codigoOrdemServico;

    require_once("../dbConnection.php");
    

    $comando = "UPDATE ordensservicos SET status=3 WHERE codigo=".$codigoOrdemServico;
    // echo $comando;

    $resultado = mysqli_query($conexao, $comando);
    
    if ($resultado==true) {
        header("Location: workOrderEditionForm.php?retorno=ok");
    } else {
        header("Location: workOrderEditionForm.php?retorno=Nok");
    }

    
    }else {
        header("Location: ../../websiteTabs/login.php");
    }

?>