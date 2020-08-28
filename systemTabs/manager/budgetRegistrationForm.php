
<?php
  

  session_start();

  	if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {


 ?>


<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title> Diretor - Orçamento </title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/manager/registerBudget.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
  <script src="../../js/manager/registerBudget.js"></script>
</head>

<body>

<?php

function calculaValorTotal($codigo, $conexao){
	
	require_once("../dbConnection.php");
	
	$sql="SELECT SUM(orcamentos_has_produtos.quantidade*orcamentos_has_produtos.precoatual) 
	as valorTotal 
	FROM orcamentos INNER JOIN orcamentos_has_produtos ON 
	orcamentos.codigo=orcamentos_has_produtos.orcamentos_codigo WHERE orcamentos.codigo=".$codigo;
	$resultadoValor=mysqli_query($conexao,$sql);
	$valorTotal=mysqli_fetch_assoc($resultadoValor);
	return $valorTotal['valorTotal'];
}
	
?>


	<?php include("managerMenuLayout.php"); ?>	

	<main id="conteudo">
	
		
		
			
			<br>
			<h1 id = "tituloPag">Orçamento </h1>
		
			<fieldset class = "fieldset">
				<legend class = "legend"> Orçamento </legend>
				
	
	<form action="registerBudget.php" method="POST"  onsubmit="return validarCampos()" id="formOrcamento">


			
<div id = "divInicio">
	<br>

	<?php

		require_once("../dbConnection.php");

		$comando = "SELECT id, nome FROM clientes";
		$resultado = mysqli_query($conexao, $comando);
		$clientes = array();
		
		while($cadaCliente = mysqli_fetch_assoc($resultado)){
			array_push($clientes, $cadaCliente);
		}


	?>			
		<label for = "cliente" class = "palavras">Cliente * </label>
			<select name = "cliente" id ="cliente" placeholder = "Selecione" class="inputs">
				<option value="0">Selecione...</option>
				<?php
					foreach($clientes as $cadaCliente) {
				?>
					<option value="<?=$cadaCliente['id'];?>"><?=$cadaCliente['nome'];?></option>
				<?php
					}
				?>
			</select>
		<br>
	
		<label for = "listaDeParcelas" class = "palavras"> Parcelas </label>
			<input list = "listaParcelas" name="parcelas" id = "parcelas" class="inputs" 
			onblur="parcelaValor()">
			<datalist id = "listaParcelas">
				<option value = "2x"> 
				<option value = "3x"> 
				<option value = "4x"> 
				<option value = "5x"> 
				<option value = "6x"> 
				<option value = "7x"> 
				<option value = "8x"> 
				<option value = "9x"> 
				<option value = "10x"> 
				<option value = "11x"> 
				<option value = "12x"> 
			</datalist>
			<br>
				
		<label for = "desconto" class = "palavras"> Desconto (%) </label>
			<input type = "text" name = "desconto" id = "desconto" class="inputs" placeholder="ex: 50" 
			onblur="descontoValorTotal()">
		<br>

	<input type="radio" name="pontoDeEntrega" id="radio1" onclick="ocultaLocalizacao()" checked value="1">
	<label for="radio1">Entregar no local do cliente</label><br>
	<input type="radio" name="pontoDeEntrega" id="radio2" onclick="mostraLocalizacao()" value="2">
	<label for="radio2">Entregar em outro local</label>

	
</div>
				
 <div id = "pontoDeEntrega">	

		<label for = "cep" class = "localEntrega"> CEP * </label>
			<input type = "text" name = "cep" id = "cep" class = "campoTexto" placeholder = "Insira seu CEP aqui">
		<br>
		
		<script type="text/javascript">$("#cep").mask("00000-000"); </script>
				
		<label for = "estado" class = "localEntrega"> Estado * </label>
			<input list = "listaEstados" name="estado" id = "estado" class = "campoTexto" placeholder = "Selecione o estado aqui" maxlength = "2">
			<datalist id = "listaEstados">
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

		<label for = "cidade" class = "localEntrega"> Cidade * </label>
			<input type = "text" name = "cidade" id = "cidade" class = "campoTexto" 
			placeholder = "Insira sua cidade aqui">
		<br>
				
		<label for = "bairro" class = "localEntrega"> Bairro * </label> 
			<input type = "text" name = "bairro" id = "bairro" class = "campoTexto" placeholder = "Insira seu bairro aqui">
		<br>
				
		<label for = "rua" class = "localEntrega"> Rua * </label>
			<input type = "text" name = "rua" id = "rua" class = "campoTexto" placeholder = "Insira sua rua aqui">
		<br>
				
		<label for = "numero" class = "localEntrega"> Número *</label>
			<input type = "text" name = "numero" id = "numero" class = "campoTexto" placeholder = "Insira seu número de casa aqui">
		
</div> 

<?php
	function mostraCategorias($conexao) {
		$comando = "SELECT codigo, nome FROM categorias";
		$resultado = mysqli_query($conexao, $comando);
		$categorias = array();

		while ($cadaCategoria = mysqli_fetch_assoc($resultado)) {
			array_push($categorias, $cadaCategoria);
		}
		$options = "<option required value='000'>Todas</option>";

		foreach($categorias as $cadaCategoria) {
			$options .= "<option value='".$cadaCategoria['codigo']."'>".$cadaCategoria['nome']."</option>";
		}
		return $options;	
	}

	function mostraProdutos($conexao) {
		$comando = "SELECT codigo, nomeProduto, categorias_codigo FROM produtos";
		$resultado = mysqli_query($conexao, $comando);
		$produtos = array();

		while($cadaProduto = mysqli_fetch_assoc($resultado)) {
			array_push($produtos, $cadaProduto);
		}
		$options2="<option required value='0'>Selecione...</option>";
		foreach($produtos as $cadaProduto) {
			$options2.="<option value='".$cadaProduto['codigo']."'>".$cadaProduto['nomeProduto'];"</option>";
		}
		return $options2;
	}


?>
<input id="todasAsCategorias" type="hidden" value="<?=mostraCategorias($conexao)?>">
<input id="todosOsProdutos" type="hidden" value="<?=mostraProdutos($conexao)?>">


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

		<tr id="linha0">
			<td>
				<select name="categorias" id="categorias0" class="categorias" 
				onchange="retornaProdutos(0)">
					<?=mostraCategorias($conexao);?>
				</select>
			</td>

			<td>
				<select name="produtos[]"  id="produtos0"  class="produtos" 
				onchange="retornaValorUnitario(0)">
					<?=mostraProdutos($conexao);?>
				</select>
			</td>

			<td>
				<input type="text" required  value="0.00" class="vlUnitario"
				id="vlUnitario0" name="valoresUnitarios[]" readonly="readonly">
			</td>

			<td>
				<input required type="number" name="qtdeProdutos[]" class="qtde"
				onblur="atualizaValorTotal(0)" id="qtde0" min="1" value="0">
			</td>

			<td>
				<input type="text" class="desc" id="desc0" name="descs[]">
			</td>

			<td>
				<button type="button" class="botaoMais" id="primeiroBotaoMais" onclick="adicionaProduto()">
					<img src="../../img/botaoMais.png" alt="botão para adicionar mais um produto" class="imgMais">
				</button>
			</td>
		</tr>

		</table>
		
		<label id="valorTotalLabel"> Valor Total </label>
			<input type="number" name="valorTotal" id="valorTotal" value="0.00" readonly="readonly"><br>

		<label class="valorCadaParcela" id="labelCadaParcela"> Valor Cada Parcela</label>
			<input type="number" class="valorCadaParcela" name="valorCadaParcela" id="valorCadaParcela" value="0.00" readonly="readonly">
		<br>
		

		
		<button type = "submit" id = "botaoFazerOrcamento"> 
		 	Fazer Orçamento
		</button>
</div>

		</form>
		
		</fieldset>
	
		<fieldset class = "fieldset">
		
		<legend class = "legend"> Consulta de Orçamentos </legend>
		
		<form action="#" method="GET"> 
			
			<label for = "campoNomeCliente" id = "nomeCliente"> Nome do Cliente </label>
				<input type = "text" name = "buscaCliente" id = "campoNomeCliente" class = "campoTexto" placeholder = "Insira o nome do cliente aqui"> 
					
				<button type = "submit" id = "botaoLupa"> 
					<img src = "../../img/lupa.png" id = "imgLupa" alt = "botão pesquisar"> 
				</button>
		</form>

		
			<table>
				<thead>
					<tr class = "linhaCabecalho">
						<th class = "campoCodigo">Código</th>
						<th id = "colunaCliente" colspan = "2">Cliente</th>
						<th class = "linhasTituloSuperior" >Emissão</th>
						<th class = "linhasTituloSuperior">Desconto</th>
						<th class = "linhasTituloSuperior">Parcela</th>
						<th class = "linhasTituloSuperior">Total</th>
						<th class = "linhasTituloSuperior" class="linhaQtde" id="colunaAcao">Ações</th>
					</tr>
				</thead>

<?php

	if (isset($_GET['buscaCliente']) && $_GET['buscaCliente']==""){
		
		$comando = 	
		"SELECT
			id, nome, desconto, parcelas, nomeProduto, preco_unitario, status, dataemissao, quantidade, 
			orcamentos.codigo, precoatual
		FROM
			clientes
		INNER JOIN
			orcamentos
		ON	
			id = clientes_id
		INNER JOIN
			orcamentos_has_produtos
		ON	
			orcamentos_codigo = orcamentos.codigo
		INNER JOIN
			produtos
		ON 
			orcamentos_has_produtos.produtos_codigo = produtos.codigo 
		WHERE
			status=1	
		GROUP BY 
			orcamentos.codigo";
		
	} else if (isset($_GET['buscaCliente'])==false) {

		$comando = 	
		"SELECT
			id, nome, desconto, parcelas, nomeProduto, preco_unitario, status, dataemissao, quantidade, 
			orcamentos.codigo, precoatual
		FROM
			clientes
		INNER JOIN
			orcamentos
		ON	
			id = clientes_id
		INNER JOIN
			orcamentos_has_produtos
		ON	
			orcamentos_codigo = orcamentos.codigo
		INNER JOIN
			produtos
		ON 
			orcamentos_has_produtos.produtos_codigo = produtos.codigo 
		WHERE
			status=1
		GROUP BY 
			orcamentos.codigo";

	} else if (isset($_GET['buscaCliente']) && $_GET['buscaCliente']!="") {
		$buscaCliente = $_GET['buscaCliente'];
		$comando = 	
		"SELECT
			id, nome, desconto, parcelas, nomeProduto, preco_unitario, status, dataemissao, quantidade, 
			orcamentos.codigo, precoatual
		FROM
			clientes
		INNER JOIN
			orcamentos
		ON	
			id = clientes_id
		INNER JOIN
			orcamentos_has_produtos
		ON	
			orcamentos_codigo = orcamentos.codigo
		INNER JOIN
			produtos
		ON 
			orcamentos_has_produtos.produtos_codigo = produtos.codigo 
		WHERE 
			LOWER(clientes.nome) LIKE '%".$buscaCliente."%' AND status=1 
		GROUP BY 
			orcamentos.codigo";
		
		
	}

	// echo $comando;	
	$resultado = mysqli_query($conexao, $comando);
	$linhas = mysqli_num_rows($resultado);
	if ($linhas == 0) {
?>
	<tr><td colspan='8' id="semOrcamento">Nenhum orçamento cadastrado</td></tr>
<?php
	} else {
		$orcamentos = array();
		while ($cadaOrca = mysqli_fetch_assoc($resultado)) {
			array_push($orcamentos, $cadaOrca);
		}

	$html = "";
	$valorTotal = "";

	foreach ($orcamentos as $cadaOrca) {

		$quantidade = $cadaOrca['quantidade'];
		$valorAtual = $cadaOrca['precoatual'];
		$desconto = $cadaOrca['desconto'];
			$valorTotal .= calculaValorTotal($cadaOrca['codigo'], $conexao);
			$valorTotal = $valorTotal*(1-$desconto/100); // dando desconto ao valor total
			$valorTotal = sprintf("%.2f", $valorTotal);
			
			$dataEmissaoBrasileira = $cadaOrca['dataemissao'];
			$dataEmissaoBrasileira = date('d/m/Y',  strtotime($dataEmissaoBrasileira));
			
			$parcela = $cadaOrca['parcelas'];
			

			if ($desconto==NULL) {
				$desconto = " - ";
			} else {
				$desconto = intval($desconto)."%";
			}

			
			if ($parcela==NULL || $parcela==0) {
				$valorParcela = " - ";
			} else {
				$valorParcela = $valorTotal / $parcela;
				$valorParcela = sprintf("%.2f", $valorParcela);
				$valorParcela = "R$ ".$valorParcela;		
			}		
			
	$html .= "
	<tr class = 'linha1'>
		<td class = 'campoCodigo'>".$cadaOrca['codigo']."</td>
		<td class = 'linhaCliente' colspan = '2'>".$cadaOrca['nome']."</td>
		<td class = 'linhasTituloSuperior' >".$dataEmissaoBrasileira."</td>
		<td class = 'campoCodigo'>".$desconto."</td>
		<td class = 'linhasTituloSuperior'>".$valorParcela."</td>	
		<td class = 'linhasTituloSuperior'>R$ ".$valorTotal."</td>
		<td>
		<form action='budgetEditionForm.php' method='POST'>
			<input type='hidden' value='".$cadaOrca['codigo']."' name='codigoOrcamento' id='inputEditar'>						
			<button type='submit' class='botaoLapis'>
				<img src='../../img/lapis.png' alt='Botão editar' class='imgLapis'>
			</button>
		</form>
		<form action='deleteBudget.php' method='POST'>
			<input type='hidden' value='".$cadaOrca['codigo']."' name='codigoOrcamento' id='inputExcluir'>
			<button type='submit' class='botaoLixeira'>
				<img src='../../img/lixeira.png' alt='Botão excluir' class='imgLixeira'>
			</button>
		</form>
		</td>
	</tr>";

		$valorTotal = "";
		$comando3 = 
		"SELECT 
			id, nomeProduto, descricaoestampa, precoatual, quantidade
		FROM	
			orcamentos_has_produtos
		INNER JOIN
			produtos
		ON 
			produtos_codigo = produtos.codigo
		INNER JOIN	
			orcamentos
		ON
			orcamentos_codigo = orcamentos.codigo
		INNER JOIN
			clientes
		ON
			clientes_id = clientes.id
		WHERE
			orcamentos.codigo =".$cadaOrca['codigo'];
		// echo $comando3."<br>";
		$resultado = mysqli_query($conexao, $comando3); // mandando p banco
			
		$orcamentos2Linha = array();
		while($cadaOrca2 = mysqli_fetch_assoc($resultado)){
			array_push($orcamentos2Linha, $cadaOrca2);
		}		
			
		$html .="
			
					<tr class='tabela2'>
						<th colspan='2' class = 'linhaProdutos'> Produto </th>
						<th colspan='4' class = 'linhaDesc'> Descrição </th>
						<th class = 'linhaPreco'> Preço </th>
						<th class = 'linhaQtde'> Quantidade </th>
					</tr>
					";

		foreach($orcamentos2Linha as $cadaOrca2){
			$html .= "
		
			<tr class = 'linhaTitutloSuperior'>
				<td colspan='2' class = 'linhaProdutos'>".$cadaOrca2['nomeProduto']."</td>
				<td colspan='4' class = 'linhaDesc'>".$cadaOrca2['descricaoestampa']."</td>
				<td class = 'linhaPreco'> R$ ".$cadaOrca2['precoatual']."</td>
				<td class= 'linhaQtde'>".$cadaOrca2['quantidade']."</td>	
			</tr>
			";				
		} 

		echo $html;
		$html = "";
		
			
		} // fechamento foreach
		
	} 
		
	
//	echo $comando2;		

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