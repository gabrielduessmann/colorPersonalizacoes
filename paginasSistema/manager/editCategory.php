<?php

  
  session_start();

  if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {

 

    require_once("../dbConnection.php");

    $codigoCategoria = $_POST['codigoCategoria'];
    $nome = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    //  echo $codigoCategoria."   ".$nome."   ".$descricao;

    $comando = "UPDATE categorias SET nome='".$nome."', descricao='".$descricao."' WHERE 
                codigo=".$codigoCategoria;

    $resultado = mysqli_query($conexao, $comando);

    if ($resultado==true) {
        header("Location: categoryRegistrationForm.php?retorno=1");
    } else {
        header("Location: categoryRegistrationForm.php?retorno=0");
    }


   
}else {
    header("Location: ../../websiteTabs/login.php");
}
  

?>