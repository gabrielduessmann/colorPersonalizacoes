
<?php


session_start();

	if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==3) {


?>


<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title>Atendente - Principal</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/attendant/home.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
</head>

<body>
		
	<?php include("attendantMenuLayout.php")?>

	<main id="conteudo">
	
		<div id="bemvindo">
		Welcome,
		<br><br>
		<p id="nomeUsuario">
	<?php
	
		require_once("../dbConnection.php");

		$comando = "SELECT nome FROM usuarios WHERE id=".$_SESSION['idLogado'];
		$resultado = mysqli_query($conexao, $comando);
		$usuario = mysqli_fetch_assoc($resultado);
		
		echo $usuario['nome'];

	?>
		</p>
		</div>

	</main>


</body>
</html>

<?php

  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>
