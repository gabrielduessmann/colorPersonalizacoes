<?php

  
	session_start();

  		if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {


 ?>


 <!DOCTYPE html>

<html lang="pt-br">

<head>
  <title>Diretor - Registro de Usuário</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/diretor/registroUsuario.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
  <script src="../../js/diretor/registroUsuario.js"></script>
</head>

<body>


<?php include("managerMenuLayout.php"); ?>





	<main id="conteudo">


			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


		<form action="editUser.php" method="POST" onsubmit="return validarCampos('editar')" id="formRegistroUsuario">

<br>
				<h2 id="titulo">Edição de Usuário</h2>


			<fieldset id="cadastroClientes" class="fieldsets">
				<legend class="legend"> Dados Pessoais do Usuário</legend>

        <?php
          require_once("../dbConnection.php");

          $idUsuario = $_POST['botaoEditar'];
          // echo "ID:".$idUsuario;
          $comando = "SELECT * FROM usuarios WHERE id=".$idUsuario;
          $resultado = mysqli_query($conexao, $comando);
          $usuario = mysqli_fetch_assoc($resultado);

          // echo $usuario['nome']."<br>";
          // echo $usuario['id']."<br>";
          // echo $usuario['email']."<br>";
         ?>

				<br>
				<div id="ladoEsquerdoGrande">

        <input class="inputsForm" onLoad="pegaId(<?=$usuario['id'];?>)" type="hidden" name="id" id="id" value="<?=$usuario['id'];?>">

				<label for="nomecompleto" class="ladoEsquerdo">Nome Completo *</label>
				<input type="text" name="nomeCompleto" value="<?=$usuario['nome'];?>" placeholder="Digite aqui seu nome" class="input"  id="nomecompleto">

				<br><br>

				<label for="email" class="ladoEsquerdo">Email *</label>
				<input type="text" name="email" value="<?=$usuario['email'];?>" placeholder="Digite aqui seu E-mail" class="input"  id="email">

				<br><br>


				<label for="cpf" class="ladoEsquerdo">CPF *</label>
				<input type="text" placeholder="Ex.: 000.000.000-00" value="<?=$usuario['cpf'];?>" class="input" name="cpf" id="cpf">


				<script type="text/javascript">$("#cpf").mask("000.000.000-00"); </script>

				<br><br>


				<label for="telefone" class="ladoEsquerdo">Telefone *</label>
				<input type="text" class="input" value="<?=$usuario['fone1'];?>" placeholder="Digite seu telefone aqui" id="telefone" name="telefone">


				<script type="text/javascript">$("#telefone").mask("(00) 00000-0000"); </script>


				<br><br>


				<label for="celular" class="ladoEsquerdo">Celular</label>
				<input type="text" class="input" value="<?=$usuario['fone2'];?>" placeholder="Digite seu celular aqui" id="celular" name="celular">


				<script type="text/javascript">$("#celular").mask("(00) 00000-0000"); </script>


				<br><br>

				<label for="usuario" class="ladoEsquerdo">Usuário *</label>
				<input type="text" class="input" onblur="validaUsuario('editar', <?=$usuario['id'];?>)" value="<?=$usuario['usuario'];?>" placeholder="Digite seu usuário aqui" id="usuario" name="usuario">


				<br><br>

				<label for="senha" class="ladoEsquerdo">Senha *</label>
				<input type="password" class="input" placeholder="Digite sua senha aqui" id="senha" name="senha">

				<br><br>

				<label class = "ladoEsquerdo" for = "estado"> Grau de permissão * </label>
					<select id = "permissao" name="permissao" class="input">
						<option value="1" <?php echo $usuario['graupermissao']==1?'selected':'';?>>Diretor</option>
						<option value="2" <?php echo $usuario['graupermissao']==2?'selected':'';?>>Customizador</option>
						<option value="3" <?php echo $usuario['graupermissao']==3?'selected':'';?>>Atendente</option>
				</select>
				<br>

				</div>

				<div id="ladoDireitoGrande">



				<label for="rua" class="ladoEsquerdo">Rua</label>
				<input type="text" placeholder="Digite aqui sua rua" value="<?=$usuario['rua'];?>" name="rua" class="input"  id="rua">

<br><br>

				<label for="numero" class="ladoEsquerdo">Número *</label>
				<input type="text" placeholder="Digite aqui o número" onkeyup="somenteNumeros(this);" value="<?=$usuario['numero'];?>" name="numero" class="input" id="numero" maxlength="4">

<br><br>

				<label for="cep" class="ladoEsquerdo">CEP *</label>
				<input type="text"   placeholder="Ex.: 00000-000" value="<?=$usuario['cep'];?>" class="input" name="cep" id="cep">

				<script type="text/javascript">$("#cep").mask("00000-000"); </script>

<br><br>

				<label for="cidade" class="ladoEsquerdo">Cidade</label>
				<input type="text" name="cidade" class="input" onkeypress="return lettersOnly(event);" value="<?=$usuario['cidade'];?>" placeholder="Digite aqui sua cidade" id="cidade">



<br><br>

				<label for="bairro" class="ladoEsquerdo">Bairro</label>
				<input type="text" name="bairro" onkeypress="return lettersOnly(event);" class="input" value="<?=$usuario['bairro'];?>" id="bairro" placeholder="Digite aqui seu Bairro">

<br><br>

				<label for = "estado" class="ladoEsquerdo"> Estado </label>
						<input list = "listaEstados" onkeypress="return lettersOnly(event);" class="input" name = "estados" value="<?=$usuario['estado'];?>" id="estado" placeholder="Escolha aqui o seu estado" maxlength="2">
					<datalist id = "listaEstados" >
						<option value = "AC"></option>
						<option value = "AL"></option>
						<option value = "AP"></option>
						<option value = "AM"></option>
						<option value = "BA"></option>
						<option value = "CE"></option>
						<option value = "DF"></option>
						<option value = "ES"></option>
						<option value = "GO"></option>
						<option value = "MA"></option>
						<option value = "MT"></option>
						<option value = "MS"></option>
						<option value = "MG"></option>
						<option value = "PA"></option>
						<option value = "PB"></option>
						<option value = "PR"></option>
						<option value = "PE"></option>
						<option value = "PI"></option>
						<option value = "RR"></option>
						<option value = "RO"></option>
						<option value = "RJ"></option>
						<option value = "RN"></option>
						<option value = "RS"></option>
						<option value = "SC"></option>
						<option value = "SP"></option>
						<option value = "SE"></option>
						<option value = "TO"></option>
					</datalist>

<br><br>
				

					<button type = "submit" class="botao" id="botaoCadastrar">
						Cadastrar
					</button>


				</div>

			</fieldset>
			</form>

</main>
</body>
</html>

 <script>
     function somenteNumeros(num) {
         var er = /[^0-9,]/;
         er.lastIndex = 0;
         var campo = num;
         if (er.test(campo.value)) {
           campo.value = "";
         }
     }
  </script>
  <script type="text/javascript">
  function lettersOnly(evt) {
    evt = (evt) ? evt : event;
    var charCode = (evt.charCode) ? evt.charCode : ((evt.keyCode) ? evt.keyCode :
        ((evt.which) ? evt.which : 0));
    if (charCode > 31 && (charCode < 65 || charCode > 90) &&
        (charCode < 97 || charCode > 122)) {
        return false;
    }
    return true;
  }
  </script>

<?php
  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>