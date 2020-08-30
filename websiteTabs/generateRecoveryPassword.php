<?php
  require_once("../systemTabs/dbConnection.php");
  session_start();

  $email = $_POST['email'];
  $usuario = $_SESSION['usuario'];

  $comando="SELECT email, nome FROM usuarios WHERE usuario='$usuario'";
  $resultado = mysqli_query($conexao, $comando);
  $results = mysqli_fetch_assoc($resultado);
  $email0 = $results['email'];
  $nome = $results['nome'];

  if ($email!=$email0) {
    header("Location: forgotMyPassword.php?retorno=0");
  }else if ($email==$email0) {

    function generatePassword($qtyCaraceters = 8)
{
    $smallLetters = str_shuffle('abcdefghijklmnopqrstuvwxyz');

    $capitalLetters = str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ');

    $numbers = (((date('Ymd') / 12) * 24) + mt_rand(800, 9999));
    $numbers .= 1234567890;

    $specialCharacters = str_shuffle('!@#$%*-');

    $characters = $capitalLetters.$smallLetters.$numbers.$specialCharacters;

    $password = substr(str_shuffle($characters), 0, $qtyCaraceters);

    return $password;
}

    $novasenha= generatePassword();
    $novasenha1 = md5($novasenha);
    $comando2 = "UPDATE usuarios SET senha = '$novasenha1' WHERE usuario='$usuario'";
    $resultado2 = mysqli_query($conexao, $comando2);

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

   $mail->Username = "YOUR_EMAIL";
   $mail->Password = "YOUR_PASSWORD";
   
   $mail->SetFrom("colorpersonalizacoes.sa@gmail.com");
   $mail->AddAddress($email);
   $mail->Subject = "Recuperação de Senha";
   $mail->Body = "Olá ".$nome.", abaixo estará a nova senha da sua conta.
   <br>A sua nova senha é '<b>".$novasenha."</b>'.<br>Ao conectar à sua conta, mude a senha imediatamente por questões de segurança.
   <br><br>Atenciosamente,<br>Color Personalizações.";


    if(!$mail->Send()) {
      header("Location: login.php?retorno=0");
    } else {
      header("Location: login.php?retorno=1");
    }
  }



 ?>
