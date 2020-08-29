<?php


  	session_start();

  		if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {

 

	require_once("../dbConnection.php");

	$idCliente = $_POST['id'];
	
	$comando1 = "SELECT id FROM clientes WHERE clientes.id NOT IN (SELECT clientes_id FROM orcamentos) AND id=".$idCliente;	// se retornar alguma linha � o que n�o tem liga��o com o or�amento

	$resultado = mysqli_query($conexao, $comando1);

	$linhas = mysqli_num_rows($resultado);


	if($linhas == 0){	
		header("Location:clientRegistrationForm.php?retorno=1");	
	} else{
		$comando2 = "DELETE FROM clientes WHERE clientes.id NOT IN (SELECT clientes_id FROM orcamentos) AND id=".$idCliente; 
		$resultado = mysqli_query($conexao, $comando2);
		header("Location:clientRegistrationForm.php?retorno=2");
	}


}else {
  header("Location: ../../websiteTabs/login.php");
}
?>




