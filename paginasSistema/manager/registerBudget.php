<?php

  
    session_start();

        if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



    require_once("../dbConnection.php");

    $cliente = $_POST['cliente'];
    // $dataEmissao = $cliente.date('Y-m-d');
    $parcelas = $_POST['parcelas'];
    $parcelas = preg_replace("/\D+/", "", $parcelas); // remove qualquer caracter não numérico das parcelas
    $desconto = $_POST['desconto'];
    $entrega = $_POST['pontoDeEntrega'];

    if ($parcelas=="") {
        $parcelas = "NULL";
    }
    if ($desconto=="") {
        $desconto="NULL";
    }
    
    if ($entrega==2) {
        $cep = $_POST['cep'];
        $cep = preg_replace("/\D+/", "", $cep); // remove qualquer caracter não numérico do cep
        $estado = $_POST['estado'];
        $cidade = $_POST['cidade'];
        $bairro = $_POST['bairro'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        // echo $cep."<br>".$estado."<br>".$cidade."<br>".$bairro."<br>".$rua."<br>".$numero."<br><br>";
        $comando = "INSERT INTO orcamentos VALUES (NULL,'".date('Y-m-d')."',".$parcelas.",".$desconto.",
        '".$cidade."',".$cep.",'".$estado."','".$rua."',".$numero.",'".$bairro."',
        ".$_SESSION['idLogado'].",".$cliente.",1)";
    } else {
    // echo $cliente."<br>".$dataEmissao."<br>".$parcelas."<br>".$desconto."<br>".$cidade;
        $comando = "INSERT INTO orcamentos VALUES (NULL,'".date('Y-m-d')."',".$parcelas.",".$desconto.",
        NULL,NULL,NULL,NULL,NULL,NULL,".$_SESSION['idLogado'].",".$cliente.",1)";
    }
    // echo $comando;

    $resultado = mysqli_query($conexao, $comando);

    $comando2 = "SELECT MAX(codigo) as codigoOrcamento FROM orcamentos";
    $resultado2 = mysqli_query($conexao, $comando2);
    $codigoOrcamento = mysqli_fetch_assoc($resultado2);

    $produtos = array();
    $produtos = $_POST['produtos'];

    $vlUnitarios = array();
    $vlUnitarios = $_POST['valoresUnitarios'];

    $qtdes = array();
    $qtdes = $_POST['qtdeProdutos'];

    $descs = array();
    $descs = $_POST['descs'];

    $resultado3=null;
    for ($i=0; $i < sizeof($produtos); $i++) {
        $comando3 = "INSERT INTO orcamentos_has_produtos VALUES (".$codigoOrcamento['codigoOrcamento'].",
        ".$produtos[$i].",".$qtdes[$i].",".$vlUnitarios[$i].",'".$descs[$i]."')";
        // echo $comando3;
        // echo $produtos[$i];
        $resultado3 = mysqli_query($conexao, $comando3);
        // echo sizeof($produtos);
    }

    if ($resultado3==true) {
        header("Location: budgetRegistrationForm.php?retorno=ok");
    } else {
        header("Location: budgetRegistrationForm.php?retorno=Nok");    
    }
?>

<?php
  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>