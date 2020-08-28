<?php


	session_start();

		if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



	require_once("../dbConnection.php");
	
// Pegando dados do banco
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

/*		echo "Id:".$idCliente."<br>"."Nome: ".$nome."<br>"."Cpf: ".$cpf."<br>"."Cnpj: ".$cnpj."<br>"."Inscricao Estadual: ".$inscricaoEstadual."<br>".
		 "Fone: ".$fone1."<br>"."Fone2: ".$fone2."<br>"."Email: ".$email."<br>"."CEP: ".$cep."<br>"."Estado: ".$estado."<br>".
		 "Cidade: ".$cidade."<br>"."Bairro: ".$bairro."<br>"."Rua: ".$rua."<br>"."Número: ".$numero;
*/

// Tirar caracteres especiais desses dados (como . e -)
	$cpf = preg_replace("/\D+/", "", $cpf); // remove qualquer caracter não numérico do cpf
	$fone1 = preg_replace("/\D+/", "", $fone1); // remove qualquer caracter não numérico do fone1
	$fone2 = preg_replace("/\D+/", "", $fone2); // remove qualquer caracter não numérico do fone2
	$cep = preg_replace("/\D+/", "", $cep); // remove qualquer caracter não numérico do cep

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
	
//	echo $comando;

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