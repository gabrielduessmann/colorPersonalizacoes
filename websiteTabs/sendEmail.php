<?php
  $nome = $_POST['nome'];
  $email = $_POST['email'];
  $motivo = $_POST['motivo'];
  $mensagem = $_POST['mensagem'];
  $telefone = $_POST['telefone'];

  switch ($motivo) {
    case '1':
      $motivo = "Elogio sobre a Empresa";
      break;

    case '2':
      $motivo = "Reclamação sobre a Empresa";
      break;

    case '3':
      $motivo = "Opinião sobre a Empresa";
      break;
  }

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

 $mail->Username = "colorpersonalizacoes.sa@gmail.com";
 $mail->Password = "eugostodeabacate";
 //FIXME - Change password to the correct one

 $mail->SetFrom($email);
 $mail->AddAddress("colorpersonalizacoes.sa@gmail.com");
 $mail->Subject = $motivo;
 $mail->Body = "Nome do Cliente: ".$nome."<br>Telefone do Cliente: ".$telefone."<br>Email do Cliente: ".$email."<br>
 Motivo: ".$motivo."<br>Mensagem: ".$mensagem;


  if(!$mail->Send()) {
    header("Location: ../index.php?retorno=0");
  } else {
    header("Location: ../index.php?retorno=1");
  }


?>
