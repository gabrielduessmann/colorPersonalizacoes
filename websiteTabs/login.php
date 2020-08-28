<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title>Entrar</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../css/login.css">
  <link rel="icon" href="../img/icone.png" type="image/png" sizes="18x18">
  <script src="../js/login.js"></script>
</head>

<body>

		<?php include("websiteMenu.php")?>

	<main id="conteudo">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

	<form action="../paginasSistema/efetuaLogin.php" method="POST" onsubmit="return validarCampos()" id="formEntrar">
		<div id="entrar">

			<label for="usuario" id="label1" class="labels">Usuário</label><br>
			<input type="text" name="usuario" onblur="validaUsuario()" id="usuario" class="inputs" placeholder="Digite seu usuário aqui"><br><br>

			<label for="senha" id="label2" class="labels">Senha</label>
			<label id="esqueciSenha" onclick="botaoEsqueci()"><a href="" id="linkEsqueciSenha">Esqueci minha senha</a></label><br>
			<input type="password" name="senha" id="senha" class="inputs" placeholder="Digite sua senha aqui">
		</div>

		<button type="reset" class="botoes" id="botao">
			<!-- <img src="../img/limpar.png" alt="botaoLimpar"> -->
		</button>

		<button type="submit"  id="botaoEntrar">
			<!-- <img src="../img/enviar.png" alt="botaoEnviar">
			 -->
			Entrar
		</button>

	</form>

	</main>

	<footer id="rodape">
		<p id="copyright">Color Personalizações &copy; 2019</p>
	</footer>

</body>
</html>
