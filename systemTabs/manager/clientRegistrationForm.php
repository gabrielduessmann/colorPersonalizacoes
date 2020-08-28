
<?php
  

  session_start();

  	if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {


 ?>


<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title> Diretor - Registro de Cliente </title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/diretor/registroCliente.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
  <script src="../../js/diretor/registroCliente.js"></script>
</head>

<body>


<?php include("managerMenuLayout.php");  ?>

	<main id="conteudo">
	
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
		
		<br>
		<h1 id = "tituloPag">Registro de Cliente </h1>
		
		<fieldset class = "fieldset"> 
		
			<legend class = "legend"> Dados Pessoais do Cliente </legend>
		
			<form action="registerClient.php" method="POST" id="formClientes" onsubmit="return validarCampos()">  
			
<div id = "divEsquerda">
			
				<label for = "nomeCompleto" class = "palavras"> Nome <br> Completo * </label>
					<input type = "text" name = "nome" class = "campoTexto" id = "nomeCompleto" placeholder = "Insira seu nome completo aqui"> 
				<br>
				<br>
					
				
<!-- -->
		<script type="text/javascript">

		function liberar(){
		var cpf = document.getElementById("cpf");	
		var cnpj= document.getElementById("cnpj");
		var inscricaoEstadual = document.getElementById("inscricaoEstadual");
		
			if(cpf.value != ""){ // cpf preenchido
				cnpj.disabled=true;
				inscricaoEstadual.disabled=true;
			} else if(cnpj.value != ""){ // cnpj preenchido
				cpf.disabled=true;
			} else if(inscricaoEstadual.value != ""){	// inscricao estadual preenchido 
				cpf.disabled=true;
			} else if(cpf.value == ""){ 
				cpf.disabled=false;
				cnpj.disabled=false;
				inscricaoEstadual.disabled=false;
			}
	
		} //fecha function

</script>

<!-- -->	
		
				<label for = "cpf" class = "palavras"> CPF </label>
					<input type = "text" name = "cpf" id = "cpf"   onblur = "liberar();" class = "campoTexto" placeholder = "Insira seu CPF aqui"> 
				<br>
					<script type="text/javascript">$("#cpf").mask("000.000.000-00"); </script>
		
				<label for = "cnpj" class = "palavras"> CNPJ </label>
					<input maxlength = "14" type = "text" name = "cnpj" onblur = "liberar();" id = "cnpj" class = "campoTexto" placeholder = "Insira seu CNPJ aqui">
				<br>	

				<label for = "inscricaoEstadual" class = "palavras"> Inscrição <br> Estadual </label>
					<input maxlength = "19" onblur = "liberar();" type = "text" name = "inscricaoEstadual" id = "inscricaoEstadual" class = "campoTexto" placeholder = "Insira sua Inscrição Estadual aqui">
				<br>	
				<br>
				
				
<!-- -->			
				
				
				<label for = "fone1" class = "palavras"> Telefone * </label>
					<input type = "text" name = "fone1" id = "fone1" class = "campoTexto" placeholder = "Insira seu telefone aqui">
				<br>
					<script type="text/javascript">$("#fone1").mask("(00)0000-0000"); </script>
					
				<label for = "celular" class = "palavras"> Celular </label>
					<input  type = "text" name = "fone2" id = "fone2" class = "campoTexto" placeholder = "Insira seu celular aqui">
				
					<script type="text/javascript">$("#fone2").mask("(00)00000-0000"); </script>
				
				<br>
				<label for = "email" class = "palavras"> E-mail *</label>
				<input type = "text" name = "email" id = "email" class = "campoTexto" placeholder = "Insira seu e-mail aqui">
				<br>
				
</div>
				
<div id = "divDireita">

				<label for = "cep" class = "palavras"> CEP </label>
				<input type = "text" name = "cep" id = "cep" class = "campoTexto" placeholder = "Insira seu CEP aqui">
				<br>
					<script type="text/javascript">$("#cep").mask("00000-000"); </script>
				
				<label class = "palavras" for = "estado"> Estado * </label>
						<input list = "listaEstados" name = "estados" id = "estado" class = "campoTexto" placeholder = "Selecione o estado aqui">
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
				<input type = "text" name = "cidade" id = "cidade" class = "campoTexto" placeholder = "Insira sua cidade aqui">
				<br>
				
				<label for = "bairro" class = "palavras"> Bairro * </label> 
				<input type = "text" name = "bairro" id = "bairro" class = "campoTexto" placeholder = "Insira seu bairro aqui">
				<br>
				
				<label for = "rua" class = "palavras"> Rua * </label>
				<input type = "text" name = "rua" id = "rua" class = "campoTexto" placeholder = "Insira sua rua aqui">
				<br>
				
				<label for = "numero" class = "palavras"> Número * </label>
				<input type = "number" name = "numero" id = "numero" class = "campoTexto" placeholder = "Insira seu número de casa aqui">
				<br>
				
				<br>
				
				<button type = "reset" id = "botaoLimpar"> 
					Limpar
				</button>

				<button type = "submit" id = "botaoCadastrar"> 
					Cadastrar
				</button>
</div>

			</form>
	
		</fieldset>
		
		<fieldset class = "fieldset">
		
			<legend class = "legend"> Consulta de Cliente </legend>
		
				<form action="#" method="GET">
			
					<label for = "campoNomeCliente" id = "nomeCliente"> Nome do Cliente </label>
						<input type = "text" name = "nomeCliente" id = "campoNomeCliente" class = "campoTexto" placeholder = "Insira o nome do cliente aqui"> 
					
						<button type = "submit" id = "botaoLupa"> <img src = "../../img/lupa.png" id = "imgLupa" alt = "botão pesquisar"> </button>
				</form>
			
			<table id = "tabela">
					<tr>
						<th class = "outrosCampos"> Nome do cliente </th>
						<th class = "outrosCampos"> Email </th>
						<th class = "outrosCampos"> CPF/CNPJ </th>
						<th class = "outrosCampos"> Ações </th>
					</tr>

<!-- consulta -->
					
	<?php
		
		require_once("../dbConnection.php");
	
		if(isset($_GET['nomeCliente'])== false){
			$comando = "SELECT * FROM clientes";
		} else if(isset($_GET['nomeCliente'])==true && $_GET['nomeCliente'] == ""){
			$comando = "SELECT * FROM clientes";
		} else if(isset($_GET['nomeCliente'])==true && $_GET['nomeCliente'] != ""){
			$buscaCliente = $_GET['nomeCliente'];
			$comando = "SELECT * FROM clientes WHERE nome LIKE '".$buscaCliente."%'";
		}
		//	echo $comando;
		
		$resultado = mysqli_query($conexao, $comando);
		
		$linhas = mysqli_num_rows($resultado);
			
			if($linhas == 0){
				
	?>
	
		<tr>
			<td colspan = "4"> Nenhum cliente encontrado na busca </td>
		</tr>
	
	<?php
			} // fechamento if linha 176
			else{
				$clientesRetornados = array();
				
				while($cadaLinha = mysqli_fetch_assoc($resultado)){
					array_push($clientesRetornados, $cadaLinha);
				}
			
				foreach($clientesRetornados as $cadaCliente){
	?>
<!-- resultado das buscas -->

		<tr>
			<td  class = "outrasClasses"> <?php echo $cadaCliente['nome']; ?> </td>
			<td  class = "outrasClasses"> <?php echo $cadaCliente['email']; ?> </td>
		
	<?php if($cadaCliente['cpf'] != ""){
	?>
			<td  class = "outrasClasses"> <?php echo $cadaCliente['cpf'] ; ?> </td> <!-- VER SE TEM CPF OU CNPJ -->
	<?php
	} else if($cadaCliente['cpf'] == ""){		
	?>
			<td class = "outrasClasses"> <?php echo $cadaCliente['cnpj'] ; ?> </td> <!-- VER SE TEM CPF OU CNPJ -->
	<?php
	}
	?>		
	
			<td class = "outrasClasses">
				<form action="clientEditionForm.php" method="POST" >
						
						<input type = "hidden" value="<?= $cadaCliente['id']; ?>" name = "id" id = "idEditar">
					
					<button type = "submit"  id = "botaoLapis"> <img src = "../../img/lapis.png" id = "imgLapis" alt = "botão editar"> </button>
					
				</form>

				<form action = "deleteCLient.php" method = "POST" >
					
						<input type = "hidden" value = "<?=$cadaCliente['id']; ?>" name = "id" id = "idExcluir">
					
					<button type = "submit" id = "botaoLixeira"> <img src = "../../img/lixeira.png" id = "imgLixeira" alt = "botão excluir"> </button>
					
				</form>	
			</td>	
		</tr>
	
	<?php
				} // fechamento foreach linha 193
			} // fechamento else linha 186
	?>

	<?php
	if(isset($_GET['retorno'])==true){
		if($_GET['retorno']==1){
			include("alertas_exclusao/erroExclusaoCliente.html");
		} else if($_GET['retorno']==2){
			include("alertas_exclusao/sucessoExclusaoCliente.html");
		}	
	}
	?>

<!-- fim consulta -->					
		</table>
		
		</fieldset>
	
	</main>

</body>
</html>



<?php
  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>