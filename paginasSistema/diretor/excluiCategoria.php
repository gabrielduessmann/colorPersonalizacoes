<?php
  

    session_start();

        if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {

 

    require_once("../conexaoBanco.php");

    $codigoCategoria = $_POST['codigoCategoria'];

    $comando = "SELECT codigo FROM produtos WHERE categorias_codigo=".$codigoCategoria;
     echo $comando;

    $resultado = mysqli_query($conexao, $comando);
    $linhas = mysqli_num_rows($resultado);

    if ($linhas==0) {
		 header("Location: registroCategoriaForm.php?retorno=1");
		  $comando = "DELETE FROM categorias WHERE codigo=".$codigoCategoria;
		 $resultado = mysqli_query($conexao, $comando);

	}else{
	
	 header("Location: registroCategoriaForm.php?retorno=2");
	}

    
    
}else {
  header("Location: ../../paginasSite/entrar.php");
}
?>


