<?php

  
  session_start();

    if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



  require_once("../dbConnection.php");

  $nome = $_POST['nomeCompleto'];
  $email = $_POST['email'];
  $cpf = preg_replace("/\D+/", "", $_POST['cpf']);
  $telefone = preg_replace("/\D+/", "", $_POST['telefone']);
  $celular = preg_replace("/\D+/", "", $_POST['celular']);
  $rua = $_POST['rua'];
  $numero = $_POST['numero'];
  $cep = preg_replace("/\D+/", "", $_POST['cep']);
  $cidade = $_POST['cidade'];
  $bairro = $_POST['bairro'];
  $estado = $_POST['estados'];
  $usuario = $_POST['usuario'];
  $senha = $_POST['senha'];
  $senha = md5($senha);
  $grauPermissao = $_POST['permissao'];

  $comando = "";

  if ($celular == "") {

    $comando = "INSERT INTO usuarios (usuario, senha, cpf, nome, graupermissao, fone1, email, cep, rua, numero, cidade, bairro, estado)
    VALUES ('".$usuario."', '".$senha."', ".$cpf.", '".$nome."', ".$grauPermissao.", ".$telefone.", '".$email."',
    ".$cep.", '".$rua."', ".$numero.", '".$cidade."', '".$bairro."', '".$estado."')";
    
  }else {

    $comando = "INSERT INTO usuarios (usuario, senha, cpf, nome, graupermissao, fone1, fone2, email, cep, rua, numero, cidade, bairro, estado)
    VALUES ('".$usuario."', '".$senha."', ".$cpf.", '".$nome."', ".$grauPermissao.", ".$telefone.", ".$celular.", '".$email."',
    ".$cep.", '".$rua."', ".$numero.", '".$cidade."', '".$bairro."', '".$estado."')";
   
  }

  $resultado = mysqli_query($conexao, $comando);

  if($resultado==true){
  	header("Location: userRegistrationForm.php?retorno=1");
  }else{
  	header("Location: userRegistrationForm.php?retorno=0");
  }


 
  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>