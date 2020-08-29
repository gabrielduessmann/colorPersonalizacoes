<?php


	session_start();

		if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



	require_once("../dbConnection.php");
	
	$idCliente = $_POST['idCliente'];	
	$nome = $_POST['nome'];
	$cpf = $_POST['cpf'];
	$cnpj = $_POST['cnpj'];
	$inscricaoEstadual = $_POST['inscricaoEstadual'];
	$fone1 = $_POST['fone1'];
	$fone2 = $_POST['fone2'];
	$email = $_POST['email'];
	
	$cep = $_POST['cep'];
	$estado = $_POST['estados']; 
	$cidade = $_POST['cidade'];
	$bairro = $_POST['bairro'];
	$rua = $_POST['rua'];
	$numero = $_POST['numero'];

	$cpf = preg_replace("/\D+/", "", $cpf); 
	$fone1 = preg_replace("/\D+/", "", $fone1); 
	$fone2 = preg_replace("/\D+/", "", $fone2); 
	$cep = preg_replace("/\D+/", "", $cep);

	if(($cnpj == "") && ($inscricaoEstadual == "")){
		$comando = "UPDATE clientes SET nome = '".$nome."', cpf = '".$cpf."', fone1 = '".$fone1."',
		fone2 = '".$fone2."', email = '".$email."', cep = '".$cep."', estado = '".$estado."', cidade = '".$cidade."', bairro = '".$bairro."',
		rua = '".$rua."', numero = '".$numero."' WHERE id=".$idCliente;
	} else if($cpf == ""){
		$comando = "UPDATE clientes SET nome = '".$nome."', cnpj = '".$cnpj."', inscricaoestadual = '".$inscricaoEstadual."', 
		fone1 = '".$fone1."', fone2 = '".$fone2."', email = '".$email."', cep = '".$cep."', estado = '".$estado."', cidade = '".$cidade."', bairro = '".$bairro."',
		rua = '".$rua."', numero = '".$numero."' WHERE id=".$idCliente;
	} else{

	$comando = "UPDATE clientes SET nome = '".$nome."', cpf = '".$cpf."', cnpj = '".$cnpj."', inscricaoestadual = '".$inscricaoEstadual."', 
	fone1 = '".$fone1."', fone2 = '".$fone2."', email = '".$email."', cep = '".$cep."', estado = '".$estado."', cidade = '".$cidade."', bairro = '".$bairro."',
	rua = '".$rua."', numero = '".$numero."' WHERE id=".$idCliente;
	}
	
	$resultado = mysqli_query($conexao, $comando);
	
	if($resultado == true){
		header("Location: clientRegistrationForm.php");
	}else{
		header("Location: clientRegistrationForm.php");
	}

	
  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 

?>