
<?php
  

  session_start();

  	if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {


 ?>


<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title>Color Personalizações</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/manager/registerCategory.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
  <script src="../../js/manager/registerCategory.js"></script>
</head>

<body>

	<?php include("managerManuLayout.php")?>

	<main id="conteudo">

		<br>

		<h1 id="head">Registro de Categoria do Produto</h1>

		<fieldset class="fieldsets">

			<legend class="legends">Dados Gerais</legend>

			<form action="registerCategory.php" method="POST" id="formRegistroCategoria" onsubmit="return validarCampos()" >

				<label for="categoria" class="palavras">Categoria *</label>
				<input type="text" id="categoria" name="categoria" class="categoria" placeholder="Informe a categoria do produto">
					<br>
				<label for="descricao" class="palavras">Descrição da Categoria  <br> do Produto </label>
					<textarea id="descricao" name="descricao"
					placeholder= "Informe a descrição da categoria do produto"></textarea>

				<br>


				<button type="submit" id="botaoCadastrar">
					 Cadastrar
				</button>



			</form>

		</fieldset>

		<fieldset class="fieldsets">

			<legend class="legends">Consulta de Categorias do Produto</legend>

		<form action="#" method="GET" id="formConsultaCategoria">
			<label for="buscaCategoria" id="consultaCampo">Categorias</label>
			<input type="text" name="buscaCategoria" class="consulta">
			<button type="submit" id="botaoLupa"><img src="../../img/lupa.png" alt="botão pesquisar" id="imgLupa"></button>
		</form>

			<br>


			<table>
				<thead>
					<tr>
						<th id="colunaCategoria">Categoria</th>
						<th id="colunaDescricao">Descrição</th>
						<th id="colunaAcoes">Ações</th>
					</tr>
				</thead>

				<tbody>

			<?php

			require_once("../dbConnection.php");

			if (isset($_GET['buscaCategoria']) && $_GET['buscaCategoria']=="") {
				$comando = "SELECT * FROM categorias";
			} else if (isset($_GET['buscaCategoria']) && $_GET['buscaCategoria']!="") {
				$buscaCategoria = $_GET['buscaCategoria'];
				$comando = "SELECT * FROM categorias WHERE nome LIKE '%".$buscaCategoria."%'";
			} else if(isset($_GET['buscaCategoria'])==false) {
				$comando = "SELECT * FROM categorias";
			}
			
			$resultado = mysqli_query($conexao, $comando);
			$linhas = mysqli_num_rows($resultado);

	

			if ($linhas == 0) {

			?>

			<tr>
				<td colspan="3">Nenhuma categoria encontrada</td>
			</tr>

			<?php

			} else {
				$categorias = array();

				while ($cadaCategoria = mysqli_fetch_assoc($resultado)) {
					array_push($categorias, $cadaCategoria);
				}

				foreach ($categorias as $cadaCategoria) {

			?>


	<tr>
		<td class="linhaNome"><?=$cadaCategoria['nome'];?></td>
		<td class="linhaDescricao"><?=$cadaCategoria['descricao'];?></td>

		<td class="linhaBotoes">
			<form action="categoryEditionForm.php" method="POST">
				<input type="hidden" value="<?=$cadaCategoria['codigo'];?>" name="codigoCategoria" id="inputEditar">
				<button type="submit" class="botaoLapis"><img src="../../img/lapis.png" alt="botao" class= "imgLapis" ></button>
			</form>

			<form action="deleteCategory.php" method="POST">
				<input type="hidden" value="<?=$cadaCategoria['codigo'];?>" name="codigoCategoria" id="inputExcluir">
				<button type="submit" class="botaoExcluir"><img src="../../img/lixeira.png" alt="botao" class= "imgExcluir" ></button>
			</form>
		</td>
	</tr>

				<?php

				}
			}

				?>

	<?php
	if(isset($_GET['retorno'])==true){
		if($_GET['retorno']==1){
			include("exclusion_alerts/successCategory.html");
		} else if($_GET['retorno']==2){
			include("exclusion_alerts/errorCategory.html");
		}	
	}
	?>

				</tbody>

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