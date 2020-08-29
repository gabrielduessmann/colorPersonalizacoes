<?php

  
    session_start();

        if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==3) {



    require_once("../dbConnection.php");

    $codigoOrcamento = $_POST['codigoOrcamento'];

    $comando = "DELETE FROM orcamentos_has_produtos WHERE orcamentos_codigo=".$codigoOrcamento;
    $resultado = mysqli_query($conexao, $comando);

    $comando2 = "SELECT dataemissao FROM orcamentos WHERE codigo=".$codigoOrcamento;
    $resultado2 = mysqli_query($conexao, $comando2);
    $dataOrcamento = mysqli_fetch_assoc($resultado2);
 
    $dataEmissao = $dataOrcamento['dataemissao']; //pegando a data de emissao do orcamento antes de ser editado
    
    $comando3 = "DELETE FROM orcamentos WHERE codigo=".$codigoOrcamento;
    $resultado3 = mysqli_query($conexao, $comando3);


    $usuarioLogado = $_SESSION['idLogado'];
    $clientes = $_POST['clientes'];
    $parcelas = $_POST['parcelas'];
    $parcelas = preg_replace("/\D+/", "", $parcelas); 
    $desconto = $_POST['desconto'];
    $entrega = $_POST['pontoDeEntrega'];

    if ($parcelas=="") {
        $parcelas = "NULL";
    }
    if ($desconto=="") {
        $desconto="NULL";
    }

    if ($entrega == "2") {
        $cidade = $_POST['cidade'];
        $cep = $_POST['cep'];
        $cep = preg_replace("/\D+/", "", $cep);
        $estado = $_POST['estado'];
        $rua = $_POST['rua'];
        $numero = $_POST['numero'];
        $bairro = $_POST['bairro'];

        $comando4 = "INSERT INTO orcamentos VALUES (".$codigoOrcamento.", '".$dataEmissao."', ".$parcelas.", ".$desconto.", '".$cidade."', ".$cep.", 
        '".$estado."', '".$rua."', ".$numero.", '".$bairro."', ".$usuarioLogado.", ".$clientes.", 1)";
    } else {
        $comando4 = "INSERT INTO orcamentos (codigo, dataemissao, parcelas, desconto, usuarios_id, clientes_id, status) VALUES
        (".$codigoOrcamento.", '".$dataEmissao."', ".$parcelas.", ".$desconto.", ".$usuarioLogado.", ".$clientes.", 1)";
    }

    $resultado4 = mysqli_query($conexao, $comando4);


    $arrayProdutos = array();
    $arrayProdutos = $_POST['produtos'];
    $arrayValoresUnitarios = array();
    $arrayValoresUnitarios = $_POST['valoresUnitarios'];
    $arrayQuantidades = array();
    $arrayQuantidades = $_POST['qtdeProdutos'];
    $arrayDescricoes = array();
    $arrayDescricoes = $_POST['descs'];

    $tamanho = sizeof($arrayProdutos);

    for ($i=0; $i < $tamanho; $i++) {
        if ($arrayDescricoes[$i] == "") {
            $arrayDescricoes[$i] = "NULL";
        } else {
            $arrayDescricoes[$i] = "'".$arrayDescricoes[$i]."'";    
        }
        $comando5 = "INSERT INTO orcamentos_has_produtos VALUES (".$codigoOrcamento.", ".$arrayProdutos[$i].", ".$arrayQuantidades[$i].",
        ".$arrayValoresUnitarios[$i].", ".$arrayDescricoes[$i].")";
        $resultado5 = mysqli_query($conexao, $comando5);
    }



    if ($resultado5==true) {
        header("Location: budgetRegistrationForm.php?retorno=ok");
    } else {    
        header("Location: budgetRegistrarionForm.php?retorno=Nok");    
    }


    }else {
        header("Location: ../../websiteTabs/login.php");
}
?>

