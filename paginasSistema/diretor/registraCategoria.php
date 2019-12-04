<?php

  
    session_start();

        if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



    require_once("../conexaoBanco.php");

    $categoria = $_POST['categoria'];
    $descricao = $_POST['descricao'];

    // echo $categoria."   ".$descricao;

    if ($descricao!="") {
        $comando = "INSERT INTO categorias VALUES (NULL, '".$categoria."', '".$descricao."')";
    } else {
        $comando = "INSERT INTO categorias VALUES (NULL, '".$categoria."', NULL)";   
    }

    // echo $comando;
    

    $resultado = mysqli_query($conexao, $comando);

    header("Location: registroCategoriaForm.php");


}else {
  header("Location: ../../paginasSite/entrar.php");
}
?>