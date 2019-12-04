<?php

  
    session_start();

        if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==3) {



    require_once("../conexaoBanco.php");

    $codigo = $_POST['id'];

    if ($codigo==0) {

    } else {
        $comando = "SELECT preco_unitario FROM produtos WHERE codigo=".$codigo;
        $resultado = mysqli_query($conexao, $comando);
        $valorUnitario = array();
        $valorUnitario = mysqli_fetch_assoc($resultado);
        echo $valorUnitario['preco_unitario'];
        
    }
?>


<?php
  }else {
    header("Location: ../../paginasSite/entrar.php");
  }
 ?>