<!DOCTYPE html>

<html lang = "pt-br">

<head>
	<title>Contato</title>
	<meta charset = "UTF-8">
	<link rel="stylesheet" href="../css/contact.css">
	<link rel="icon" href="../img/icone.png" type="image/png" sizes="18x18">
	<script src="../js/contact.js"></script>
</head>

<body>

		<?php include("websiteMenu.php")?>



	<main id="conteudo">


			<div id="divFormContatoEsquerda">
		<h3 id="tituloMensagem">Deixe sua mensagem!</h3>

			<form action="enviaEmail.php" method="POST"  onsubmit="return validarCampos()" id="formContato">

				<label class="campos" for="nome">Nome Completo</label><br>
				<input class="camposForm" type="text" name="nome" id="nome" placeholder="Digite seu nome completo aqui"><br>

				<label class="campos" for="email">E-mail</label><br>
				<input class="camposForm" type="text" name="email" id="email" placeholder="Digite seu e-mail aqui"><br>

				<label class="campos" for="mensagem">Motivo para o contato</label><br>
				<select  id="motivoContato" name="motivo">
					<option value="0">Selecione uma opção</option>
					<option value="1">Elogio</option>
					<option value="2">Reclamação</option>
					<option value="3">Opinião</option>
				</select><br>

				<label class="campos" for="mensagem">Mensagem</label><br>
				<textarea style="resize: none" name="mensagem" class="camposForm" id="mensagem" placeholder="Digite sua mensagem aqui"
				rows="3"></textarea><br>


				<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
				<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

				<label class="campos">Telefone</label><br>
				<input type="text" class="camposForm" placeholder="Digite seu telefone aqui" id="telefone" name="telefone"><br>


				<script type="text/javascript">$("#telefone").mask("(00) 00000-0000"); </script>

				<button type="reset" class="botoes">
					<img src="../img/limpar.png" alt="botao reset">
				</button>
				<button type="submit" class="botoes">
					<img src="../img/enviar.png" alt="enviar">
				</button>

			</form>
		</div>
		<br>
		<br>

		<div id="enderecoDiv">
			<address id="endereco">


			<p id="tituloLocalizacao"> Localização da empresa: </p> <br>
			<p id="textoEndereco">
			Rua Arno Waldemar Dohler, 957<br>
			Zona Industrial Norte - Joinville/SC<br>
			CEP: 89223-001<br>
			Telefone: (47)3441-7700
			</p>

			<iframe id = "mapa" src="https://www.google.com/maps/embed?pb=!1m18!
			1m12!1m3!1d3578.0534269103396!2d-48.85542498548852!3d-26.259929372
			617588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x94deafb
			96971c5db%3A0xc3cd2c63a198607c!2sR.+Arno+Waldemar+Dohler%2C+957+-+
			Zona+Industrial+Norte%2C+Joinville+-+SC%2C+89223-001!5e0!3m2!1spt-
			BR!2sbr!4v1555615711913!5m2!1spt-BR!2sbr"
			width="400" height="200" frameborder="0"
			style="border:0" ></iframe>


			<p id="tituloAtendimento">Horário de atendimento: </p> <br>
			<p id="textoAtendimento">Segunda a sexta: das 08:00 às 18:00<br>
			<br></p>
		</address>
		</div>


	</main>




	<footer id="rodape">
		<p id="copyright">Color Personalizações &copy; 2019</p>
	</footer>

</body>

</html>
