<?php
  

  session_start();

    if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



  require_once("../dbConnection.php");

  $nomeProduto = $_POST['nomeProduto'];
  $preco = $_POST['preco'];
  $categoria = $_POST['categoria'];

  // echo $nomeProduto."<br>";
  // echo $preco."<br>";
  // echo $categoria."<br>";

  $comando="INSERT INTO produtos (nomeProduto, preco_unitario, categorias_codigo) VALUES ('".$nomeProduto."', ".$preco.", ".$categoria.")";

  // echo $comando;

  $resultado=mysqli_query($conexao,$comando);

  header("Location: productRegistrationForm.php");

 
  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>
