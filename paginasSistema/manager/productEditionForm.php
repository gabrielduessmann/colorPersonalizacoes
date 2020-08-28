
<?php
  
  
	session_start();

  		if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {


 ?>


<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title>Diretor - Edição de produto</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/diretor/registroProduto.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
  <script src="../../js/diretor/registroProduto.js"></script>
</head>

<body>


	<?php include("managerMenuLayout.php");?>




	<main id="conteudo">

		<form action="editProduct.php" method="POST" id="formRegistroProduto" onsubmit="return validarCampos()">

		<br>

			<h2 id="titulo">Edição de Produto</h2>

		<fieldset id="fieldProduto">
			<legend class="legend">Dados do Produto</legend>

			<div id="cadastroProduto"> 

        <?php
          require_once("../dbConnection.php");
          $idProduto=$_POST['idProduto'];
// echo $idProduto;
          $comando="SELECT * FROM produtos WHERE codigo=".$idProduto;
          $resultado= mysqli_query($conexao,$comando);
          $produto = mysqli_fetch_assoc($resultado);

          // echo $produto['codigo'];
          // echo $produto['nomeProduto'];
         ?>

         <form action="editProduct.php" method="POST">
           <input type="hidden" name="idProduto" id="idProduto" value="<?=$produto['codigo']?>">


				<label for="nomeProduto" class="labelProduto" id="nomeDoProduto">Nome do produto *</label>
				<input type="text" class="input" name="nomeProduto" placeholder="Digite aqui o nome do produto" id="nomeProduto" value="<?=$produto['nomeProduto'];?>">



				<label for="preco" class="labelProduto">Preço unitário *</label>
				<input type="number" class="input" name="preco" placeholder="Digite aqui o preço unitário" id="preco" value="<?=$produto['preco_unitario'];?>">


<?php
$categoria="";
$cadaCategoria="";
 ?>
				<label for="categoria" class="labelProduto">Categoria produto *</label>
				<select = "listaCategoria" class="input" name = "categoria" id = "categoria" placeholder="Categoria do produto">




              <?php
                require_once("../dbConnection.php");
                $comando="SELECT codigo, nome FROM categorias";
                // echo $comando;
                  $resultado=mysqli_query($conexao,$comando);

                  $categorias=array();
                  while($cadaCategoria = mysqli_fetch_assoc($resultado)){
                    array_push($categorias, $cadaCategoria);
                  }

                  foreach ($categorias as $cadaCategoria){
                    ?>
                    <option value="<?php echo $cadaCategoria['codigo']?>"><?=$cadaCategoria['nome'];?></option>
                    <?php
                  }
                     ?>


					</select>


					<button type = "submit" id="botaoCadastrar" class="botao">
             			Editar
          			</button>
		
		</iv>

  	</fieldset>
		</form>



	</main>


</body>
</html>

<?php
  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>
