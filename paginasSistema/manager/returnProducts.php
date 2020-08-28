<?php

  
    session_start();

        if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



    require_once("../dbConnection.php");
    
    $codigo = $_POST['id'];
    

    if ($codigo==0) {
        $comando = "SELECT codigo, nomeProduto, categorias_codigo FROM produtos";
    } else {
        $comando = "SELECT codigo, nomeProduto, categorias_codigo FROM produtos WHERE categorias_codigo=".$codigo;
    }
    
    $resultado = mysqli_query($conexao, $comando);
    $linhas = $resultado->num_rows;
    $produtos = array();
    
    while ($cadaProduto = mysqli_fetch_assoc($resultado)){
        array_push($produtos, $cadaProduto);
    }
    
    $options="";
    
    if ($linhas==0) {
       $options.="<option required value='0'>Sem produto cadastrado</option>";
    } else {
        $options = "<option value='0'>Selecione...</option>";
    }
    foreach($produtos as $cadaProduto) {
        $options .= "<option value='".$cadaProduto['codigo']."'>".$cadaProduto['nomeProduto']."</option>";
    }

        echo $options;
    

?>


<?php
  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>

