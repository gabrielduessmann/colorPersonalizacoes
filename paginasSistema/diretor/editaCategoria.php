<?php

  
  session_start();

  if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {

 

    require_once("../conexaoBanco.php");

    $codigoCategoria = $_POST['codigoCategoria'];
    $nome = $_POST['categoria'];
    $descricao = $_POST['descricao'];
    //  echo $codigoCategoria."   ".$nome."   ".$descricao;

    $comando = "UPDATE categorias SET nome='".$nome."', descricao='".$descricao."' WHERE 
                codigo=".$codigoCategoria;

    $resultado = mysqli_query($conexao, $comando);

    if ($resultado==true) {
        header("Location: registroCategoriaForm.php?retorno=1");
    } else {
        header("Location: registroCategoriaForm.php?retorno=0");
    }


   
}else {
    header("Location: ../../paginasSite/entrar.php");
}
  

?>