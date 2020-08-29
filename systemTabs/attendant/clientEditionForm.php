
<?php


session_start();

	if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==3) {


?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title> Diretor - Edição de Cliente </title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/manager/registerClient.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
  <script src="../../js/manager/editClient.js"></script>
</head>

<body>

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>

<?php

	include("attendantMenuLayout.php");
?>
<br>
<h1 id = "tituloPag">Edição de Cliente </h1>
		
		<fieldset class = "fieldset"> 
		
			<legend class = "legend"> Dados Pessoais do Cliente </legend>
		
		<?php 
		
			require_once("../dbConnection.php");
			
			$idCliente = $_POST['id'];
		
			$comando = "SELECT * FROM clientes WHERE id=".$idCliente;
		
			$resultado = mysqli_query($conexao, $comando);
			$cliente = mysqli_fetch_assoc($resultado);
		?>
			
		
		
			<form action="editClient.php" method="POST" id="formClientes" onsubmit="return validarCampos()">  
			
<div id = "divEsquerda">

			<input type="hidden" name="idCliente" value="<?=$cliente['id'];?>">
			
				<label for = "nomeCompleto" class = "palavras"> Nome <br> Completo * </label>
					<input value = "<?=$cliente['nome'];?>" type = "text" name = "nome" class = "campoTexto" id = "nomeCompleto" placeholder = "Insira seu nome completo aqui"> 
				<br>
				<br>
					
				<label for = "cpf" class = "palavras"> CPF </label>
					<input  value = "<?=$cliente['cpf'];?>" type = "text" name = "cpf" id = "cpf" class = "campoTexto" placeholder = "Insira seu CPF aqui"> 
					
						<script type="text/javascript">$("#cpf").mask("000.000.000-00"); </script>
				
				<br>
					<script type="text/javascript">$("#cpf").mask("000.000.000-00"); </script>
				
				<label for = "cnpj" class = "palavras"> CNPJ </label>
					<input maxlength = "14" value = "<?=$cliente['cnpj'];?>" type = "text" name = "cnpj" id = "cnpj" class = "campoTexto" placeholder = "Insira seu CNPJ aqui">
				<br>	
				
				<label for = "inscricaoEstadual" class = "palavras"> Inscrição <br> Estadual </label>
					<input maxlength = "19" value = "<?=$cliente['inscricaoestadual'];?>" type = "text" name = "inscricaoEstadual" id = "inscricaoEstadual" class = "campoTexto" placeholder = "Insira sua Inscrição Estadual aqui">
				<br>	
				<br>
				
				<label for = "fone1" class = "palavras"> Telefone * </label>
					<input maxlength = "10" value = "<?=$cliente['fone1'];?>" type = "text" name = "fone1" id = "fone1" class = "campoTexto" placeholder = "Insira seu telefone aqui">
				<br>
					<script type="text/javascript">$("#fone1").mask("(00)0000-0000"); </script>
					
				<label for = "celular" class = "palavras"> Celular </label>
					<input maxlength = "11" value = "<?=$cliente['fone2'];?>" type = "text" name = "fone2" id = "celular" class = "campoTexto" placeholder = "Insira seu celular aqui">
				<br>
					<script type="text/javascript">$("#celular").mask("(00)00000-0000"); </script>

				<label for = "email" class = "palavras"> E-mail </label>
				<input value = "<?=$cliente['email'];?>" type = "text" name = "email" id = "email" class = "campoTexto" placeholder = "Insira seu e-mail aqui">
				<br>
				
</div>
				
<div id = "divDireita">

				<label for = "cep" class = "palavras"> CEP </label>
				<input maxlength = "8" value = "<?=$cliente['cep'];?>" type = "text" name = "cep" id = "cep" class = "campoTexto" placeholder = "Insira seu CEP aqui">
				<br>
					
				
				<label class = "palavras" for = "estado"> Estado * </label>
						<input value = "<?=$cliente['estado'];?>" list = "listaEstados" name = "estados" id = "estado" class = "campoTexto" placeholder = "Selecione o estado aqui">
						<datalist id = "listaEstados">
				<option value = "AC"> </option>
				<option value = "AL"> 
				<option value = "AP"> 
				<option value = "AM"> 
				<option value = "BA"> 
				<option value = "CE"> 
				<option value = "DF"> 
				<option value = "ES"> 
				<option value = "GO"> 
				<option value = "MA"> 
				<option value = "MT"> 
				<option value = "MS"> 
				<option value = "MG"> 
				<option value = "PA"> 
				<option value = "PB"> 
				<option value = "PR"> 
				<option value = "PE"> 
				<option value = "PI"> 
				<option value = "RR"> 
				<option value = "RO"> 
				<option value = "RO"> 
				<option value = "RJ"> 
				<option value = "RN"> 
				<option value = "RS"> 
				<option value = "SC"> 
				<option value = "SP"> 
				<option value = "SE"> 
				<option value = "TO"> 
						</datalist>
				<br>
				
				<label for = "cidade" class = "palavras"> Cidade * </label>
				<input value = "<?=$cliente['cidade'];?>" type = "text" name = "cidade" id = "cidade" class = "campoTexto" placeholder = "Insira sua cidade aqui">
				<br>
				
				<label for = "bairro" class = "palavras"> Bairro * </label> 
				<input value = "<?=$cliente['bairro'];?>" type = "text" name = "bairro" id = "bairro" class = "campoTexto" placeholder = "Insira seu bairro aqui">
				<br>
				
				<label for = "rua" class = "palavras"> Rua * </label>
				<input value = "<?=$cliente['rua'];?>" type = "text" name = "rua" id = "rua" class = "campoTexto" placeholder = "Insira sua rua aqui">
				<br>
				
				<label for = "numero" class = "palavras"> Número * </label>
				<input value = "<?=$cliente['numero'];?>" type = "text" name = "numero" id = "numero" class = "campoTexto" placeholder = "Insira seu número de casa aqui">
				<br>
				
				<br>
				
				<button type = "reset" id = "botaoRestaurar"> 
					Restaurar
				</button>

				<button type = "submit" id = "botaoEditar"> 
					Editar
				</button>
</div>

			</form>
	
		</fieldset>


<?php

  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>