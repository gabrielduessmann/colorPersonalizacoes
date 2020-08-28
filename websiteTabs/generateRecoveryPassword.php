<?php
  require_once("../paginasSistema/conexaoBanco.php");
  session_start();

  $email = $_POST['email'];
  $usuario = $_SESSION['usuario'];
  // echo $nome." ".$cpf." ".$email." ".$_SESSION['usuario'];

  $comando="SELECT email, nome FROM usuarios WHERE usuario='$usuario'";
  $resultado = mysqli_query($conexao, $comando);
  $results = mysqli_fetch_assoc($resultado);
  $email0 = $results['email'];
  $nome = $results['nome'];

  if ($email!=$email0) {
    header("Location: esqueciminhasenha.php?retorno=0");
  }else if ($email==$email0) {

    function generatePassword($qtyCaraceters = 8)
{
    //Letras minúsculas embaralhadas
    $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

    //Letras maiúsculas embaralhadas
    $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

    //Números aleatórios
    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
    $numbers .= 1234567890;

    //Caracteres Especiais
    $specialCharacters = str_shuffle('!@#$%*-');

    //Junta tudo
    $characters = $capitalLetters.$smallLetters.$numbers.$specialCharacters;

    //Embaralha e pega apenas a quantidade de caracteres informada no parâmetro
    $password = substr(str_shuffle($characters), 0, $qtyCaraceters);

    //Retorna a senha
    return $password;
}

    $novasenha= generatePassword();
    $novasenha1 = md5($novasenha);
    $comando2 = "UPDATE usuarios SET senha = '$novasenha1' WHERE usuario='$usuario'";
    $resultado2 = mysqli_query($conexao, $comando2);
    // echo $comando2;

    // email para mostrar a senha
    require("/PHPMailer-master/src/PHPMailer.php");
    require("/PHPMailer-master/src/SMTP.php");
    require("/PHPMailer-master/src/Exception.php");


    $mail = new PHPMailer\PHPMailer\PHPMailer();
    $mail->IsSMTP();

   $mail->CharSet="UTF-8";
   $mail->Host = "smtp.gmail.com";
   $mail->SMTPDebug = 1;
   $mail->Port = 465 ; //465 or 587

   $mail->SMTPSecure = 'ssl';
   $mail->SMTPAuth = true;
   $mail->IsHTML(true);

   //Authentication
   $mail->Username = "colorpersonalizacoes.sa@gmail.com";
   $mail->Password = "eugostodeabacate";

   //Set Params
   $mail->SetFrom("colorpersonalizacoes.sa@gmail.com");
   $mail->AddAddress($email);
   $mail->Subject = "Recuperação de Senha";
   $mail->Body = "Olá ".$nome.", abaixo estará a nova senha da sua conta.
   <br>A sua nova senha é '<b>".$novasenha."</b>'.<br>Ao conectar à sua conta, mude a senha imediatamente por questões de segurança.
   <br><br>Atenciosamente,<br>Color Personalizações.";


    if(!$mail->Send()) {
      header("Location: entrar.php?retorno=0");
    } else {
      header("Location: entrar.php?retorno=1");
    }
  }



 ?>
