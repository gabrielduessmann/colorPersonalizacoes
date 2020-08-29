<?php



session_start();

	if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==3) {


	require_once("../dbConnection.php");
	

	$nome = $_POST['nome'];
	$cpf = $_POST['cpf'];
	$cnpj = $_POST['cnpj'];
	$inscricaoEstadual = $_POST['inscricaoEstadual'];
	if($inscricaoEstadual == NULL){
				$inscricaoEstadual = NULL;
			}	
			
	$fone1 = $_POST['fone1'];
		$fone2 = $_POST['fone2'];
			if($fone2 == NULL){
				$fone2 = 0;
			}	
	
	$email = $_POST['email'];
	
	$cep = $_POST['cep'];
	$estado = $_POST['estados']; 
	$cidade = $_POST['cidade'];
	$bairro = $_POST['bairro'];
	$rua = $_POST['rua'];
	$numero = $_POST['numero'];
	
	
	$cpf = preg_replace("/\D+/", "", $cpf); 
	$cnpj = preg_replace("/\D+/", "", $cnpj); 
	$fone1 = preg_replace("/\D+/", "", $fone1);
	$fone2 = preg_replace("/\D+/", "", $fone2); 
	$cep = preg_replace("/\D+/", "", $cep); 



	if($cpf==""){
		$comando = "INSERT INTO clientes VALUES(NULL, '".$nome."', NULL, '".$cnpj."', '".$fone1."', '".$fone2."', 
				'".$inscricaoEstadual."', '".$estado."', '".$cidade."', '".$cep."', '".$email."', '".$numero."', '".$bairro."', '".$rua."')";
	} else if(($cpf=="") && ($fone2=="")){
		$comando = "INSERT INTO clientes VALUES(NULL, '".$nome."', NULL, '".$cnpj."', '".$fone1."', '".$fone2."', 
				'".$inscricaoEstadual."', '".$estado."', '".$cidade."', '".$cep."', '".$email."', '".$numero."', '".$bairro."', '".$rua."')";
				
	}
	else if(($cnpj=="") && ($inscricaoEstadual=="")){
		$comando = "INSERT INTO clientes VALUES(NULL, '".$nome."', '".$cpf."', NULL, '".$fone1."', '".$fone2."', NULL,
					'".$estado."', '".$cidade."', '".$cep."', '".$email."', '".$numero."', '".$bairro."', '".$rua."')";
	} else if(($cnpj=="") && ($inscricaoEstadual=="") && ($fone2=="")){
		$comando = "INSERT INTO clientes VALUES(NULL, '".$nome."', '".$cpf."', NULL, '".$fone1."', NULL, 
				NULL, '".$estado."', '".$cidade."', '".$cep."', '".$email."', '".$numero."', '".$bairro."', '".$rua."')";
	}
	 else if($fone2==""){
		$comando = "INSERT INTO clientes VALUES(NULL, '".$nome."', '".$cpf."', '".$cnpj."', '".$fone1."', NULL, 
				'".$inscricaoEstadual."', '".$estado."', '".$cidade."', '".$cep."', '".$email."', '".$numero."', '".$bairro."', '".$rua."')";
	} else if($cnpj == ""){
		$comando = "INSERT INTO clientes VALUES(NULL, '".$nome."', '".$cpf."', NULL, '".$fone1."', '".$fone2."', 
				'".$inscricaoEstadual."', '".$estado."', '".$cidade."', '".$cep."', '".$email."', '".$numero."', '".$bairro."', '".$rua."')";
	} else if($inscricaoEstadual==""){
		$comando = "INSERT INTO clientes VALUES(NULL, '".$nome."', '".$cpf."', '".$cnpj."', '".$fone1."', '".$fone2."', 
				NULL, '".$estado."', '".$cidade."', '".$cep."', '".$email."', '".$numero."', '".$bairro."', '".$rua."')";
	} else if(($cnpj=="") && ($fone2=="")){
		$comando = "INSERT INTO clientes VALUES(NULL, '".$nome."', NULL, '".$cnpj."', '".$fone1."', '".$fone2."', 
				'".$inscricaoEstadual."', '".$estado."', '".$cidade."', '".$cep."', '".$email."', '".$numero."', '".$bairro."', '".$rua."')";
	} else if(($inscricaoEstadual=="") && ($fone2=="")){
		$comando = "INSERT INTO clientes VALUES(NULL, '".$nome."', '".$cpf."', '".$cnpj."', '".$fone1."', NULL, 
				NULL, '".$estado."', '".$cidade."', '".$cep."', '".$email."', '".$numero."', '".$bairro."', '".$rua."')";
	}
	

	else{	
	$comando = "INSERT INTO clientes VALUES(NULL, '".$nome."', '".$cpf."', '".$cnpj."', '".$fone1."', '".$fone2."', 
				'".$inscricaoEstadual."', '".$estado."', '".$cidade."', '".$cep."', '".$email."', '".$numero."', '".$bairro."', '".$rua."')";
	}
	

	$resultado = mysqli_query($conexao, $comando);

	if($resultado == true){
		header("Location: clientRegistrationForm.php");
	} else{
		header("Location: clientRegistrationForm.php");
	}

	
}else {
  header("Location: ../../websiteTabs/login.php");
}
?>
