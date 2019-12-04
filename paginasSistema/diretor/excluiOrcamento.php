<?php
  

    session_start();

        if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



    require_once("../conexaoBanco.php");
    
    $codigo = $_POST['codigoOrcamento'];

    $comando = "SELECT codigo FROM ordensservicos WHERE orcamentos_codigo=".$codigo;
    // echo $comando;
    $resultado = mysqli_query($conexao, $comando);
    $linhas = mysqli_num_rows($resultado);
    if ($linhas==0) {
        $comando2 = "DELETE FROM orcamentos_has_produtos WHERE orcamentos_codigo=".$codigo;
        $resultado2 = mysqli_query($conexao, $comando2);

        $comando3 = "DELETE FROM orcamentos WHERE codigo=".$codigo;
        $resultado3 = mysqli_query($conexao, $comando3);

        header("Location: registroOrcamentoForm.php?retorno=certo");
    } else {
        header("Location: registroOrcamentoForm.php?retorno=erro");
    }

    
  }else {
    header("Location: ../../paginasSite/entrar.php");
  }
 ?>