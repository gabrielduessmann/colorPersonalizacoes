<?php


  session_start();

    if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



  require_once("../conexaoBanco.php");

  $id = $_POST['id'];
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
  $senhaMD5 = md5($senha);
  $grauPermissao = $_POST['permissao'];

  // echo $nome.$id;
  // echo $nome.$email.$cpf;

  if ($celular == "" && $senha!="") {
    $comando = "UPDATE usuarios SET nome='".$nome."', email='".$email."', cpf=".$cpf.", fone1=".$telefone.",
    rua='".$rua."', numero=".$numero.", cep=".$cep.", cidade='".$cidade."', bairro='".$bairro."', estado='".$estado."', usuario='".$usuario."',
    senha='".$senhaMD5."', graupermissao=".$grauPermissao." WHERE id=".$id;
  }
  if ($celular == "" && $senha=="") {
    $comando = "UPDATE usuarios SET nome='".$nome."', email='".$email."', cpf=".$cpf.", fone1=".$telefone.",
    rua='".$rua."', numero=".$numero.", cep=".$cep.", cidade='".$cidade."', bairro='".$bairro."', estado='".$estado."', usuario='".$usuario."',
    graupermissao=".$grauPermissao." WHERE id=".$id;
  }
  if ($celular!="" && $senha=="") {
    $comando = "UPDATE usuarios SET nome='".$nome."', email='".$email."', cpf=".$cpf.", fone1=".$telefone.", fone2=".$celular.",
    rua='".$rua."', numero=".$numero.", cep=".$cep.", cidade='".$cidade."', bairro='".$bairro."', estado='".$estado."', usuario='".$usuario."',
    graupermissao=".$grauPermissao." WHERE id=".$id;
  }
  if($celular!="" && $senha != ""){
    $comando = "UPDATE usuarios SET nome='".$nome."', email='".$email."', cpf=".$cpf.", fone1=".$telefone.", fone2=".$celular.",
    rua='".$rua."', numero=".$numero.", cep=".$cep.", cidade='".$cidade."', bairro='".$bairro."', estado='".$estado."', usuario='".$usuario."',
    senha='".$senhaMD5."', graupermissao=".$grauPermissao." WHERE id=".$id;
  }

  // echo $comando;
  $resultado = mysqli_query($conexao, $comando);

  if ($resultado==true) {
    header("Location: registroUsuarioForm.php?retorno=1");
  }else {
    header("Location: registroUsuarioForm.php?retorno=0");
  }

  
}else {
  header("Location: ../../paginasSite/entrar.php");
}
?>
