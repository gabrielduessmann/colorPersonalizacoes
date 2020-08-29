
<?php
  

  session_start();

  	if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {


 ?>


 <!DOCTYPE html>

<html lang="pt-br">

	<head>
  		<title>Diretor - Registro de Usuário</title>
  		<meta charset="UTF-8">
		<link rel="stylesheet" href="../../css/manager/registerUser.css">
		<link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
		<script src="../../js/manager/registerUser.js"></script>
</head>

<body>


<?php include("managerMenuLayout.php"); ?>





	<main id="conteudo">


			<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>


		<form action="registerUser.php" method="POST" onsubmit="return validarCampos('sim')" id="formRegistroUsuario">

<br>
				<h2 id="titulo">Registro de Usuário</h2>


			<fieldset id="cadastroClientes" class="fieldsets">
				<legend class="legend"> Dados Pessoais do Usuário</legend>

				<br>
				<div id="ladoEsquerdoGrande">

				<label for="nomecompleto" class="ladoEsquerdo">Nome Completo *</label>
				<input type="text" name="nomeCompleto" placeholder="Digite aqui seu nome" class="input"  id="nomecompleto">

				<br><br>

				<label for="email" class="ladoEsquerdo">Email *</label>
				<input type="text" name="email" placeholder="Digite aqui seu E-mail" class="input"  id="email">

				<br><br>


				<label for="cpf" class="ladoEsquerdo">CPF *</label>
				<input type="text" placeholder="Ex.: 000.000.000-00" class="input" name="cpf" id="cpf">


				<script type="text/javascript">$("#cpf").mask("000.000.000-00"); </script>

				<br><br>


				<label for="telefone" class="ladoEsquerdo">Telefone *</label>
				<input type="text" class="input" placeholder="Digite seu telefone aqui" id="telefone" name="telefone">


				<script type="text/javascript">$("#telefone").mask("(00) 00000-0000"); </script>


				<br><br>


				<label for="celular" class="ladoEsquerdo">Celular</label>
				<input type="text" class="input" placeholder="Digite seu celular aqui" id="celular" name="celular">


				<script type="text/javascript">$("#celular").mask("(00) 00000-0000"); </script>


				<br><br>

				<label for="usuario" class="ladoEsquerdo">Usuário *</label>
				<input type="text" class="input" onblur="validaUsuario()" placeholder="Digite seu usuário aqui" id="usuario" name="usuario">

				<br><br>

				<label for="senha" class="ladoEsquerdo">Senha *</label>
				<input type="password" class="input" placeholder="Digite sua senha aqui" id="senha" name="senha">

				<br><br>

				<label class = "ladoEsquerdo" for = "estado"> Grau de permissão * </label>
						<select id = "permissao" name="permissao" class="input">
							<option value="1">Diretor</option>
      				<option value="2">Customizador</option>
      				<option value="3">Atendente</option>
						</select>
				<br>

				</div>

			<div id="ladoDireitoGrande">



				<label for="rua" class="ladoEsquerdo">Rua *</label>
				<input type="text" placeholder="Digite aqui sua rua" name="rua" class="input"  id="rua">

<br><br>	

				<label for="numero" class="ladoEsquerdo">Número *</label>
				<input type="text" placeholder="Digite aqui o número" onkeyup="somenteNumeros(this);" name="numero" class="input" id="numero" maxlength="4">

<br><br>

				<label for="cep" class="ladoEsquerdo">CEP *</label>
				<input type="text"   placeholder="Ex.: 00000-000" class="input" name="cep" id="cep">

				<script type="text/javascript">$("#cep").mask("00000-000"); </script>

<br><br>

				<label for="cidade" class="ladoEsquerdo">Cidade *</label>
				<input type="text" name="cidade" class="input" onkeypress="return lettersOnly(event);" placeholder="Digite aqui sua cidade" id="cidade">



<br><br>

				<label for="bairro" class="ladoEsquerdo">Bairro *</label>
				<input type="text" name="bairro" onkeypress="return lettersOnly(event);"  class="input" id="bairro" placeholder="Digite aqui seu Bairro">

<br><br>

				<label for = "estado" class="ladoEsquerdo"> Estado *</label>
						<input list = "listaEstados" onkeypress="return lettersOnly(event);" class="input" name = "estados" id="estado" placeholder="Escolha aqui o seu estado" maxlength="2">
					<datalist id = "listaEstados">
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
					<button type = "reset" class="botao" id="botaoLimpar">
						Limpar
				</button>

					<button type = "submit" class="botao" id="botaoCadastrar">
						Cadastrar
					</button>
				</div>
			</fieldset>
			</form>
			
	

	<fieldset id="consultaUsuarios" class="fieldsets">
    <legend class="legend">Consulta de Usuários</legend>
		
		<form action="userRegistrationForm.php" method="GET" id="formConsultaUsuario">
					<label for="consultaUsuario" id="legendaConsulta">Nome do Usuário</label>
					<input type="text" name="consultaUsuario" id="consultaUsuario" placeholder="Insira o nome do usuário aqui">
						<button type = "submit" class="botaoConsulta" id="botaoConsulta">
							<img src = "../../img/lupa.png" alt="botao para consultar o usuário" id="imgLupa">
            </button>
		</form>
		
<br><br>

    <table id="tabela">

      <tr>
		<th id="tabelaPermissao">Permissão</th>
        <th id="tabelaNome">Nome Completo</th>
        <th id="tabelaEmail">E-mail</th>
        <th id="tabelaAcoes">Ações</th>
      </tr>

      <?php
        require_once("../dbConnection.php");

        $comando = "";

        if (isset($_GET['consultaUsuario'])==false) {
          $comando = "SELECT * FROM usuarios";

        }elseif (isset($_GET['consultaUsuario'])==true && $_GET['consultaUsuario']=="") {
          $comando = "SELECT * FROM usuarios";

        }elseif (isset($_GET['consultaUsuario'])==true && $_GET['consultaUsuario']!="") {
          $busca = $_GET['consultaUsuario'];
          $comando="SELECT * FROM usuarios WHERE LOWER(nome) LIKE '".$busca."%'";
        }

        $resultado = mysqli_query($conexao, $comando);
        $linhas = mysqli_num_rows($resultado);

        if ($linhas == 0) {

       ?>

       <tr>
         <td class = "outrasClasses" colspan="4">Nunhum usuário encontrado</td>
       </tr>

	  <?php
		}
        else{
          $usuariosRetornados = array();

          while ($cadaLinha = mysqli_fetch_assoc($resultado)) {
            array_push($usuariosRetornados, $cadaLinha);
          }
		  $grauPermissao = "";
          foreach ($usuariosRetornados as $cadaUsuario) {
			  
				$grauPermissao = $cadaUsuario['graupermissao'];
				switch ($grauPermissao) {
					case 1:
						$grauPermissao = "Diretor";
						break;
					case 2:
						$grauPermissao = "Customizador";
						break;
					case 3:
						$grauPermissao = "Atendente";
						break;
				}
      ?>

      <tr>
	  	<td class="outrasClasses"><?=$grauPermissao;?></td>
        <td class = "outrasClasses"> <?php echo $cadaUsuario['nome'];?> </td>
        <td class = "outrasClasses"> <?php echo $cadaUsuario['email'];?> </td>
        <td class = "outrasClasses">
		
          <form action="userEditionForm.php" method="POST">
				<input type="hidden" name="botaoEditar" id="botaoEditar" value="<?=$cadaUsuario['id'];?>">
				<button type="submit" class="botaoLapis">
				<img src="../../img/lapis.png" class="imgLapis" alt="botao editar" />
				</button>
          </form>

          <form action="deleteUser.php" method="POST">
				<input type="hidden" name="botaoExcluir" id="botaoExcluir" value="<?=$cadaUsuario['id'];?>">
				<button type="submit" class="botaoLixeira">
				<img src="../../img/lixeira.png" class="imgLixeira" alt="botao excluir" />
				</button>
          </form>
		  
        </td>
      </tr>

      <?php
    }
  }
       ?>

     </table>

</fieldset>


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
</main>
</body>
</html>


<?php

  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>
 
