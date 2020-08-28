
<?php

  
  session_start();

    if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {
      

 ?>


<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title>Diretor - Registro de Produto</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/diretor/registroProduto.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
  <script src="../../js/manager/registerProduct.js"></script>
</head>

<body>


<?php include("managerMenuLayout.php");?>




	<main id="conteudo">

		<form action="registerProduct.php" method="POST" id="formRegistroProduto" onsubmit="return validarCampos()">

		<br>

			<h2 id="titulo">Registro de Produto</h2>

		<fieldset id="fieldProduto">
			<legend class="legend">Dados do Produto</legend>
      <?php
      $categoria="";
      $cadaCategoria="";
       ?>

      <div id="cadastroProduto"> 

      <label for="categoria" class="labelProduto">Categoria produto *</label>
       <select list = "listaCategoria" class="input" name = "categoria" id = "categoria" placeholder="Categoria do produto">
             <option value="0">Selecione...</option>
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

				<label for="nomeProduto" class="labelProduto" id="nomeDoProduto">Nome do produto *</label>
				<input type="text" class="input" name="nomeProduto" placeholder="Digite aqui o nome do produto" id="nomeProduto">

				<label for="preco" class="labelProduto">Preço unitário *</label>
				<input type="number" class="input" name="preco" placeholder="Digite aqui o preço unitário" id="preco">

          


					<button type = "submit" id="botaoCadastrar" class="botao">
            <!-- <img src = "../../img/registrar.png" alt="botão para rgistrar produto"> 
             -->Cadastrar
          </button>
            
      </div>
<?php
  require_once("../dbConnection.php");

 ?>

  	</fieldset>
		</form>


		<fieldset id="fieldConsultaProdutos">
			<legend id="legendConsultaProdutos" class="legend">Consulta de Produtos</legend>
      <form action="#" method="GET" id="formConsultaProduto">

			<label for="consultaProdutos" id="legendaProdutos">Nome do produto</label>
					<input type="text" name="consultaProdutos" id="consultaProdutos" placeholder="Insira o nome do produto aqui">
						<button type = "submit" class="botao" id="search">
							<img src = "../../img/lupa.png" alt="BotaoSubmit" id="imgLupa"> </button>

		</form>



<table id="tabela">
<thead>
<tr>
<th class="linhaNome">Nome</th>
<th class="linhaPreco">Preço unitário</th>
<th class="linhaCategoria">Categoria</th>
<th class="linhaAcoes">Ações</th>
</tr>
</thead>

<?php
  if((isset($_GET['consultaProdutos']))==true && $_GET['consultaProdutos']==""){
    $comando="SELECT p.*, c.nome FROM produtos as p INNER JOIN categorias as c on p.categorias_codigo=c.codigo";
  }else if((isset($_GET['consultaProdutos']))==false){
    $comando="SELECT p.*, c.nome FROM produtos as p INNER JOIN categorias as c on p.categorias_codigo=c.codigo";
  }else if((isset($_GET['consultaProdutos']))==true && $_GET['consultaProdutos']!=""){
    $buscaNomeProduto=$_GET['consultaProdutos'];
    $comando="SELECT p.*, c.nome FROM produtos as p INNER JOIN categorias as c on p.categorias_codigo=c.codigo WHERE LOWER (p.nomeProduto) LIKE '".$buscaNomeProduto."%'";
  }
  $resultado=mysqli_query($conexao,$comando);
  $linhas = mysqli_num_rows($resultado);
  if($linhas==0){
      ?>
      <tr>
        <td colspan="5">
          Nenhum produto encontrado
        </td>
      </tr>

      <?php
    }
    else {
  		$produtos = array();

  		while($cadaProduto = mysqli_fetch_assoc($resultado)){
  			array_push($produtos, $cadaProduto);
  		}

  		foreach ($produtos as $cadaProduto) {

   ?>
   <tr>
     <td class="colunaNomeProduto"><?=$cadaProduto['nomeProduto'];?></td>
     <td class="colunaPreco">R$ <?php echo number_format($cadaProduto['preco_unitario'], 2, ',', '');?></td>
     <td class="colunaNome"><?=$cadaProduto['nome'];?></td>

     <td class="colunaBotoes">
      <form action="productEditionForm.php" method="POST">
        <input type="hidden" name="idProduto" value="<?=$cadaProduto['codigo'];?>">
        <button type="submit" name="button" class="botaoLapis"><img src="../../img/lapis.png" alt="botao" class="imgLapis"></button>
      </form>

      <form action="deleteProduct.php" method="post">
        <input type="hidden" name="idProduto" value="<?=$cadaProduto['codigo'];?>">
        <button type="submit" name="button" class="botaoLixeira"><img src="../../img/lixeira.png" alt="botao" class="imgLixeira"></button>
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
			include("alertas_exclusao/erroExclusaoProduto.html");
		} else if($_GET['retorno']==2){
			include("alertas_exclusao/sucessoExclusaoProduto.html");
		}	
	}
	?>

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