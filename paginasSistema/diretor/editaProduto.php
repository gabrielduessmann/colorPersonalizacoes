<?php

  
  session_start();

    if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {

 

    require_once("../conexaoBanco.php");

    $id=$_POST['idProduto'];
    $nome=$_POST['nomeProduto'];
    $preco=$_POST['preco'];
    $categoria=$_POST['categoria'];

    // echo $nome;
    // echo $preco;
    // echo $categoria;

    $comando="UPDATE produtos SET nomeProduto='".$nome."', preco_unitario=".$preco.", categorias_codigo=".$categoria." WHERE codigo=".$id;

    // echo $comando;

    $resultado=mysqli_query($conexao, $comando);

    header("Location: registroProdutoForm.php");



  }else {
    header("Location: ../../paginasSite/entrar.php");
  }
 ?>
 
