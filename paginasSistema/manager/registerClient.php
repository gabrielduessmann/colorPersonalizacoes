<?php

  
  	session_start();

  		if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



	require_once("../dbConnection.php");
	
	
// Pegando dados do banco
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
	
	
// Tirar caracteres especiais desses dados (como . e -)
	$cpf = preg_replace("/\D+/", "", $cpf); // remove qualquer caracter não numérico do cpf
	$cnpj = preg_replace("/\D+/", "", $cnpj); // remove qualquer caracter não numérico do cnpj
	$fone1 = preg_replace("/\D+/", "", $fone1); // remove qualquer caracter não numérico do fone1
	$fone2 = preg_replace("/\D+/", "", $fone2); // remove qualquer caracter não numérico do fone2
	$cep = preg_replace("/\D+/", "", $cep); // remove qualquer caracter não numérico do cep


/*	echo "Nome: ".$nome."<br>"."Cpf: ".$cpf."<br>"."Cnpj: ".$cnpj."<br>"."Inscricao Estadual: ".$inscricaoEstadual."<br>".
		 "Fone: ".$fone1."<br>"."Fone2: ".$fone2."<br>"."Email: ".$email."<br>"."CEP: ".$cep."<br>"."Estado: ".$estado."<br>".
		 "Cidade: ".$cidade."<br>"."Bairro: ".$bairro."<br>"."Rua: ".$rua."<br>"."Número: ".$numero;
*/
	// cpf, cnpj, insc est, celular, email podem ir como null


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
	

	else{	// caso tudo for preenchido
	$comando = "INSERT INTO clientes VALUES(NULL, '".$nome."', '".$cpf."', '".$cnpj."', '".$fone1."', '".$fone2."', 
				'".$inscricaoEstadual."', '".$estado."', '".$cidade."', '".$cep."', '".$email."', '".$numero."', '".$bairro."', '".$rua."')";
	}
	
//	echo $comando;

	$resultado = mysqli_query($conexao, $comando);

	if($resultado == true){
		header("Location: clientRegistrationForm.php");
	} else{
		header("Location: clientRegistrationForm.php");
	}

?>


<?php
  }else {
    header("Location: ../../paginwebsiteTabsasSite/login.php");
  }
 ?>