<?php
  

  session_start();

    if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



 require_once("../dbConnection.php");

 $id = $_POST['idProduto'];
 //echo $id;

 $comando = "SELECT codigo FROM produtos WHERE codigo NOT IN (SELECT produtos_codigo FROM orcamentos_has_produtos) AND codigo=".$id;
 echo $comando;

  $resultado = mysqli_query($conexao, $comando);
  $linhas = mysqli_num_rows($resultado);

 

 //  echo $comando2;

 if($linhas == 0){
	 header("Location: productRegistrationForm.php?retorno=1");
 }else{
    $comando2 = "DELETE FROM produtos WHERE codigo NOT IN (SELECT produtos_codigo FROM orcamentos_has_produtos) AND codigo=".$id;
	$resultado = mysqli_query($conexao, $comando2);
    header("Location: productRegistrarionForm.php?retorno=2");
 }
     
 
}else {
  header("Location: ../../websiteTabs/login.php");
}
?>