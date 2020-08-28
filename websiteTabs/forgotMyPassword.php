<!DOCTYPE html>

<html lang="pt-br">
<head>
	<title>Entrar</title>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<link rel="stylesheet" href="../css/esqueciminhasenha.css">
	<link rel="icon" href="../img/icone.png" type="image/png" sizes="18x18">
	<script src="../js/esqueciminhasenha.js"></script>
</head>

<body>

		<?php include("websiteMenu.php")?>

	<main id="conteudo">

	<?php
		if (isset($_GET['retorno']) && $_GET['retorno']==0) {
			echo "<script>alert('Email e/ou CPF incompatíveis com o banco de dados.');</script>";
		}
	 ?>

	<form action="emailSenha.php" method="POST" onsubmit="return validarCampos()" id="recuperarSenha">
	<div id="esqueciSenha">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


		<script type="text/javascript">$("#cpf").mask("000.000.000-00"); </script>

		<label for="senha" id="label3" class="labels">E-mail</label><br>
		<input type="text" name="email" onclick="exibeMsg()" id="email" class="inputs" placeholder="Digite seu e-mail aqui">
	</div>

		<button type="reset" class="botoes" id="botao">
			<img src="../img/limpar.png">
		</button>

		<button type="submit" class="botoes">
			<img src="../img/enviar.png">
	</form>
		</button>

	</main>

	<footer id="rodape">
		<p id="copyright">Color Personalizações &copy; 2019</p>
	</footer>

</body>
</html>
