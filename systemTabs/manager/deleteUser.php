<?php


  session_start();

    if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



  require_once("../dbConnection.php");

  $id = $_POST['botaoExcluir'];

  $comando1 = "SELECT id FROM usuarios WHERE id NOT IN (SELECT usuarios_id FROM orcamentos) AND id=".$id;
  //echo $comando1;

  $resultado = mysqli_query($conexao, $comando1);

  $linhas = mysqli_num_rows($resultado);
  //echo $linhas;


 // $comando = "DELETE FROM usuarios WHERE id NOT IN (SELECT usuarios_id FROM orcamentos) AND id=".$id;
  //echo $comando;

    if($linhas == 0){
  		header("Location: userRegistrationForm.php?retorno=1");
  	}else{
	$comando2 = "DELETE FROM usuarios WHERE usuarios.id NOT IN (SELECT usuarios_id FROM orcamentos) AND usuarios.id=".$id;
//	echo $comando2;
	$resultado = mysqli_query($conexao, $comando2);
  		header("Location: userRegistrationForm.php?retorno=2");
  	}
 

  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>