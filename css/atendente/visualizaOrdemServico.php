
<?php


  session_start();


    if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==3) {


?>


<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title> Diretor - Ordem de Serviço </title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/diretor/registroOrcamento.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
  <script src="../../js/diretor/registroOrdemServico.js"></script>
</head>

<body>

	<?php include("menuDiretor.php"); ?>	

	<main id="conteudo">	
			
	<br>
	<h1 id = "tituloPag">Ordem de Serviço </h1>
		
	<fieldset class = "fieldset">

	<legend class = "legend"> Orçamento </legend>
				
	
	<form action="registroOrdemServicoForm.php" method="POST"  onsubmit="return validarCamposOrdemServico()">



<?php

    require_once("../conexaoBanco.php");

    $codigoOrcamento = $_POST['codigoOrcamento'];
    
    $comando = "SELECT cep FROM orcamentos WHERE codigo=".$codigoOrcamento;
    $resultado = mysqli_query($conexao, $comando);
    $endereco = mysqli_fetch_assoc($resultado);
    

    $comando = "SELECT * FROM orcamentos WHERE codigo=".$codigoOrcamento;
        
    $resultado = mysqli_query($conexao, $comando);
    $orcamento = mysqli_fetch_assoc($resultado);

    $parcelas;
    $desconto;

    if ($orcamento['parcelas']==NULL) {
        $parcelas = "";
    } else {
        $parcelas = $orcamento['parcelas']."x";
    }

    if ($orcamento['desconto']==NULL) {
        $desconto = ""; 
    } else {
        $desconto = $orcamento['desconto'];
    }

    $comando2 = "SELECT nome FROM clientes 
    INNER JOIN orcamentos 
    ON codigo=clientes_id
    WHERE codigo=".$codigoOrcamento;
    $resultado2 = mysqli_query($conexao, $comando2);
    $cliente = mysqli_fetch_assoc($resultado2);

?>

<input type="hidden" name="codigoOrcamento" value="<?=$codigoOrcamento;?>">	
			
<div id = "divInicio">
	<br>

	<?php
        $comando = 
        "SELECT nome 
        FROM clientes
        INNER JOIN orcamentos
        ON clientes_id=id
        WHERE codigo=".$codigoOrcamento;

		$resultado = mysqli_query($conexao, $comando);
		$cliente = mysqli_fetch_assoc($resultado);
	?>	


		<label class = "palavras">Cliente </label>	
		
            <input type="text" id="clientes" class="inputs" value="<?=$cliente['nome'];?>"
            readonly>
				
		
		<br><br>
	
        <label class = "palavras"> Parcelas </label>
    
			<input type="text" id = "parcelas" class="inputs" value="<?=$parcelas;?>" readonly>

			<br>
				
		<label class = "palavras"> Desconto (%) </label>
            <input type = "text" id = "desconto" class="inputs" value="<?=$desconto;?>" readonly>
        
		<br>

	<?php
    if ($orcamento['cep'] == NULL) { // entregar no local do cliente
    ?>
        <input type="radio" name="pontoDeEntrega" id="radio1" onclick="ocultaLocalizacao()" checked value="1">
	    <label for="radio1">Entregar no local do cliente</label><br>
	    <input type="radio" name="pontoDeEntrega" id="radio2" onclick="mostraLocalizacao()" value="2">
	    <label for="radio2">Entregar em outro local</label>
    <?php
    } else { // entregar em outro local
    ?>
        <input type="radio" name="pontoDeEntrega" id="radio1" onclick="ocultaLocalizacao()" value="1">
	    <label for="radio1">Entregar no local do cliente</label><br>
	    <input type="radio" name="pontoDeEntrega" id="radio2" onclick="mostraLocalizacao()" checked value="2">
	    <label for="radio2">Entregar em outro local</label>
        <style>
            #pontoDeEntrega {
                display: block;
            }   
        </style>

    <?php
    }
    ?>

    <script>
        $(':radio:not(:checked)').attr('disabled', true);
    </script>
	
</div>

<div id = "pontoDeEntrega">	

<?php
if ($orcamento['cep'] != NULL) { 
?>		

		<label class = "localEntrega"> CEP </label>
			<input type = "text" id = "cep" class = "campoTexto" value="<?=$orcamento['cep'];?>" readonly>
		<br>
		
		<script type="text/javascript">$("#cep").mask("00000-000"); </script>
				
		<label for = "estado" class = "localEntrega"> Estado </label>
			<input type="text" id = "estado" class = "campoTexto" value="<?=$orcamento['estado'];?>" readonly>
		<br>

		<label class = "localEntrega"> Cidade </label>
			<input type = "text"  id = "cidade" class = "campoTexto" value="<?=$orcamento['cidade'];?>" readonly>
		<br>
				
		<label class = "localEntrega"> Bairro </label> 
			<input type = "text" id = "bairro" class = "campoTexto" value="<?=$orcamento['bairro'];?>" readonly>
		<br>
				
		<label class = "localEntrega"> Rua </label>
			<input type = "text" id = "rua" class = "campoTexto" value="<?=$orcamento['rua'];?>" readonly>
		<br>
				
		<label class = "localEntrega"> Número </label>
			<input type = "text"  id = "numero" class = "campoTexto" value="<?=$orcamento['numero'];?>" readonly> 

<?php
}
?>		
</div> 

<?php

    $comando = 	
        "SELECT
        precoatual, quantidade, descricaoestampa,
        nomeProduto, codigo
        FROM
        orcamentos_has_produtos
        INNER JOIN
        produtos
        ON	
        produtos_codigo=codigo
        WHERE
        orcamentos_codigo=".$codigoOrcamento;
    $resultado = mysqli_query($conexao, $comando);
	$produtosOrcamento = array();
	$linhas = mysqli_num_rows($resultado);

    while ($cadaProdutoOrcamento = mysqli_fetch_assoc($resultado)) {
        array_push($produtosOrcamento, $cadaProdutoOrcamento);
    }   

?>


<div id = "divInferior">

		
	<table id = "tabelaProdutos">


		<tr>
		<th class = "palavrasTabelaProduto"> Categoria </th>
		<th class = "palavrasTabelaProduto"> Produto </th>
		<th class = "palavrasTabelaProduto"> Valor unitário </th>
		<th class = "palavrasTabelaProduto"> Quantidade </th>
		<th class = "palavrasTabelaProduto"> Descrição </th>
		<th id="acoes"></th>
		</tr>

<?php
	$valorTotal=0;
	$cont = 0;
    foreach ($produtosOrcamento as $cadaProdutoOrcamento) {	

?>
		<tr id=<?="linha".$cont;?>>
			<td>
			
                <input id="<?="categorias".$cont;?>" class="categorias" value="Linha 225 (arrumar)" readonly>
			</td>

			<td>

                <input class="produtos" value="<?=$cadaProdutoOrcamento['nomeProduto'];?>" readonly>
				
			</td>

			<td>
				<input type="text" class="vlUnitario" id="<?="vlUnitario".$cont;?>" 
                value="<?=$cadaProdutoOrcamento['precoatual'];?>" readonly> 
			</td>

			<td>
                <input type="number" class="qtde" id="<?="qtde".$cont;?>" value="<?=$cadaProdutoOrcamento['quantidade'];?>" readonly>
			</td>

			<td>
				<input type="text" class="desc" id="<?="desc".$cont;?>" value="<?=$cadaProdutoOrcamento['descricaoestampa'];?>" readonly>
			</td>

			
		</tr>

<?php
	$cont = $cont + 1;

	$valorTotal = $valorTotal + $cadaProdutoOrcamento['precoatual'] * $cadaProdutoOrcamento['quantidade'];
	
	}
	$desconto = 1;
	$valorParcelado=0;

	if ($orcamento['desconto']!=NULL) {
		$desconto = 1-$orcamento['desconto']/100;		
	}
	$valorTotal = $valorTotal * $desconto;
	
	if ($orcamento['parcelas']!=NULL) {
		$valorParcelado = $valorTotal / $orcamento['parcelas'];		
?>

	<style>
		#labelCadaParcela, #valorCadaParcela{
			display: inline;
		}
	</style>

<?php
	}
	
?>

		</table>

		
		<label id="valorTotalLabel"> Valor Total </label>
			<input type="number" name="valorTotal" id="valorTotal" value="<?=$valorTotal;?>" readonly><br>

		<label class="valorCadaParcela" id="labelCadaParcela"> Valor Cada Parcela</label>
			<input type="number" class="valorCadaParcela" name="valorCadaParcela" id="valorCadaParcela" value="<?=$valorParcelado;?>" 
			readonly>
        <br>
      

		
		<button type = "submit" id = "botaoVoltar"> 
            Voltar
        </button>




</div>

		</form>
		
		</fieldset>
	
	</main>

</body>
</html>


<?php
  }else {
    header("Location: ../../paginasSite/entrar.php");
  }
 ?>