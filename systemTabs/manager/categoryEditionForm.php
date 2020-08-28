
<?php


	session_start();

		if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {


?>


<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title>Color Personalizações</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/diretor/registroCategoria.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
  <script src="../../js/diretor/editaCategoria.js"></script>
</head>

<body>

	<?php include("managerMenuLayout.php")?>

	<main id="conteudo">

	<?php
	
		require_once("../dbConnection.php");

		$codigoCategoria = $_POST['codigoCategoria'];
		// echo $codigoCategoria;
		$comando = "SELECT * FROM categorias WHERE codigo=".$codigoCategoria;
		$resultado = mysqli_query($conexao, $comando);
		$categoria = mysqli_fetch_assoc($resultado);
	
	
	?>

		<br>

		<h1 id="head">Registro de Categoria do Produto</h1>

		<fieldset class="fieldsets">

		<legend class="legends">Dados Gerais</legend>

		<form action="editCategory.php" method="POST" id="formRegistroCategoria" onsubmit="return validarCampos()" >

			<input type="hidden" name="codigoCategoria" value="<?=$categoria['codigo'];?>">

			<label for="categoria" class="palavras">Categoria *</label>
			<input type="text" id="categoria" name="categoria" class="categoria"
			placeholder="Informe a categoria do produto" value="<?=$categoria['nome'];?>">
				<br>
			<label for="descricao" class="palavras">Descrição da Categoria  <br> de Produto *</label>
			<textarea id="descricao" name="descricao"
			placeholder= "Informe a descrição da categoria do produto"><?=$categoria['descricao'];?></textarea>

			<br>


			<button type="submit" id="botaoCadastrar">
					 Editar
			</button>



			</form>

		</fieldset>

	</main>


</body>
</html>

<?php
  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>
 
