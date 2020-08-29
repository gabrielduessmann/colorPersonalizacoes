
<?php
  

	session_start();

		if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {


 ?>


<!DOCTYPE html>

<html lang="pt-br">
<?php $html = ""; ?>
<head>
  <title>Diretor - Relatório de Orçamentos</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/manager/budgetReport.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">

</head>

<body>
<?php
$html2 = "";
function calculaValorTotal($codigo, $conexao){

	$sql="SELECT SUM(orcamentos_has_produtos.quantidade*orcamentos_has_produtos.precoatual)
	as valorTotal
	FROM orcamentos INNER JOIN orcamentos_has_produtos ON
	orcamentos.codigo=orcamentos_has_produtos.orcamentos_codigo where orcamentos.codigo=".$codigo;
	$resultadoValor=mysqli_query($conexao,$sql);
	$valorTotal=mysqli_fetch_assoc($resultadoValor);
	return $valorTotal['valorTotal'];
}

?>

<?php include("managerMenuLayout.php");  ?>


	<main id="conteudo">

		<br>

		<h1 id="head"> Relatório de Orçamentos </h1>

		<fieldset class="fieldsets">

			<legend class="legends">Filtros</legend>

			<form action="#" method="GET" id="formRelatoriosOrcamentos">

				<div id="esquerda">

				<label for="cliente" class = "palavras">Cliente</label>
					<select name = "listaCliente" id = "listaCliente" placeholder = "Selecione">
						<option value = ""> Selecione </option>
						<?php

					require_once("../dbConnection.php");

					$comando = "SELECT
										id, nome, codigo, status, dataemissao
								FROM
										clientes
								INNER JOIN
										orcamentos ON id = clientes_id
								GROUP BY
									id";

					$resultado=mysqli_query($conexao,$comando);

					$clientes=array();

					while($cadaCli = mysqli_fetch_assoc($resultado)){
						array_push($clientes,$cadaCli);
					}

					foreach($clientes AS $cadaCli){
				?>
					<option value = "<?=$cadaCli['id']; ?>"> <?=$cadaCli['nome'];?> </option>
				<?php
					} 
				?>
					</select>

				<br>

				<label for="status" class = "palavras">Status</label>
				<select name="status" class="status" id = "status">
					<option value = ""> Selecione... </option>
					<option value="1">Em aberto</option>
					<option value="2">Rejeitado</option>
					<option value="3">Finalizado</option>
				</select>
				<br>

				</div>

				<div id="direita">

				<label for="dataInicial" class = "palavras">Data Inicial</label>
				<input type="date" id="dataInicial" name="dataInicial" class="dataInicial">
				<br>

				<label for="dataFinal" class = "palavras">Data Final</label>
				<input type="date" id="dataFinal" name="dataFinal" class="dataFinal">

				<br>

				</div>

				<button type="submit" id = "botaoFiltrar" >
				 	Filtar
				</button>
				

			</form>

		</fieldset>


		<fieldset class="fieldsets">

			<legend class="legends">Relatório</legend>

			<br>

			<table>
				<thead>
					<tr class = "linhaCabecalho">
						<th class = "campoCodigo">Código</th>
						<th class = "linhaCliente" colspan = "2">Cliente</th>
						<th class = "linhasTituloSuperior" >Emissão</th>
						<th class = "linhasTituloSuperior" >Desconto</th>
						<th class = "linhasTituloSuperior">Total</th>
					</tr>
				</thead>

	<?php

	$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
		orcamentos_has_produtos.produtos_codigo = produtos.codigo GROUP BY orcamentos.codigo";

	// Se usuário clicar no filtrar
	if((isset($_GET['listaCliente'])) && (isset($_GET['status'])) && (isset($_GET['dataInicial'])) && (isset($_GET['dataFinal']))){
		$clienteCodigo = $_GET['listaCliente'];
		$status = $_GET['status'];
		$dataInicial = $_GET['dataInicial'];
		$dataFinal = $_GET['dataFinal'];

		$dataAtual=date('Y/m/d');
		$dataMinima='2000/01/01';

	if(($clienteCodigo == "") && ($status == "") && ($dataInicial == "") && ($dataFinal == "")){ // apertou filtrar sem digitar nenhum campo
		$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
		orcamentos_has_produtos.produtos_codigo = produtos.codigo GROUP BY orcamentos.codigo";


} else if(($clienteCodigo != "") && ($status != "") && ($dataInicial != "") && ($dataFinal != "")){ // se usuario informou todos os campos ADICIONEI status, dataEmissao, add no primeiro if tbm dps
		$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
			dataemissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND status = '".$status."' AND clientes.id=".$clienteCodigo." GROUP BY orcamentos.codigo";
	} else if(($clienteCodigo != "") && ($status == "") && ($dataInicial == "") && ($dataFinal == "")){ // tem somente cliente informado
		$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
			clientes.id='".$clienteCodigo."' GROUP BY orcamentos.codigo ";
	} else if(($clienteCodigo != "") && ($status != "") && ($dataInicial == "") && ($dataFinal == "")){ // tem cliente e status somente
		$comando2 = "SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
			status = '".$status."' AND clientes.id='".$clienteCodigo."' GROUP BY orcamentos.codigo";
	} else if(($clienteCodigo != "") && ($status != "") && ($dataInicial != "") && ($dataFinal == "")){ // tem cliente, status e dataInicial somente
		$comando2 = "SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
		dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND status = '".$status."' AND clientes.id='".$clienteCodigo."' GROUP BY orcamentos.codigo";
	} else if(($status != "") && ($clienteCodigo == "") && ($dataInicial == "") && ($dataFinal == "")){ // tem status somente
		$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
		status ='".$status."' GROUP BY orcamentos.codigo";
	} else if(($dataInicial != "") && ($clienteCodigo == "") && ($status == "") && ($dataFinal == "")){ // tem data inicial somente
		$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
		dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."'  GROUP BY orcamentos.codigo";
	} else if(($dataInicial != "") && ($clienteCodigo != "") && ($status == "") && ($dataFinal == "")){ // tem dataInicial e cliente
		$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
		dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND clientes.id='".$clienteCodigo."' GROUP BY orcamentos.codigo";
	} else if(($dataFinal != "") && ($dataInicial == "") && ($status == "") && ($clienteCodigo == "")){ // tem dataFinal somente
		$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
		dataemissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' GROUP BY orcamentos.codigo";
	} else if(($dataFinal != "") && ($clienteCodigo != "") && ($status == "") && ($dataInicial == "")){ // tem dataFinal e Cliente somente
		$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
		dataemissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND clientes.id='".$clienteCodigo."' GROUP BY orcamentos.codigo";
	} else if(($dataFinal != "") && ($clienteCodigo != "") && ($status != "") && ($dataInicial == "")){ // tem dataFinal, Cliente e status somente
		$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
		dataemissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND status = '".$status."' AND clientes.id='".$clienteCodigo."' GROUP BY orcamentos.codigo";
	} else if(($clienteCodigo != "") && ($dataInicial != "") && ($dataFinal != "") && ($status = "")){ // tem cliente, dataInicial e dataFinal somente
		$comando2 = "SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
		dataemissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND clientes.id='".$clienteCodigo."' GROUP BY orcamentos.codigo";
	} else if(($status != "") && ($dataInicial != "") && ($dataFinal == "") && ($clienteCodigo == "")){ // tem status e dataInicial somente
		$comando2 = "SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
		dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' GROUP BY orcamentos.codigo";
	} else if(($status != "") && ($dataFinal != "") && ($dataInicial == "") && ($clienteCodigo == "")){ // tem status e dataFinal somente
		$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
			dataemissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND status = '".$status."' GROUP BY orcamentos.codigo";
	} else if(($status != "") && ($dataInicial != "") && ($dataFinal != "") && ($clienteCodigo == "")){ // tem status, dataInicial e dataFinal somente
		$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
			dataemissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND status = '".$status."' GROUP BY orcamentos.codigo";
	} else if(($dataInicial != "") && ($dataFinal != "") && ($status == "") && ($clienteCodigo == "")){ // tem dataInicial e dataFinal somente
			$comando2 = "
	SELECT
		id, nome, nomeProduto, preco_unitario, status, dataemissao, quantidade, orcamentos.codigo, precoatual, desconto
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
			dataemissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' GROUP BY orcamentos.codigo";
	}
	$resultado = mysqli_query($conexao, $comando2);

	$linhas = mysqli_num_rows($resultado);
	$html2 = "";

	if($linhas == 0){
	?>
		<tr> <td colspan = "7"> Nenhum orçamento encontrado </td> </tr>

	<?php
	} 
	else {
		$orcamentos = array();
		while($cadaOrca = mysqli_fetch_assoc($resultado)){
			array_push($orcamentos, $cadaOrca);
		}

		$html = "";


		$valorTotal = "";

		foreach($orcamentos as $cadaOrca){
			$quantidade = $cadaOrca['quantidade'];
			$valorAtual = $cadaOrca['precoatual'];
			$desconto = $cadaOrca['desconto'];
			$valorTotal .= calculaValorTotal($cadaOrca['codigo'], $conexao);
			$valorTotal = $valorTotal*(1-$desconto/100); // dando desconto ao valor total
			$valorTotal = number_format($valorTotal, 2, ',', '');

			if ($desconto==NULL) {
				$desconto = " - ";
			} else {
				$desconto = intval($desconto)."%";
			}

			$dataEmissaoBrasileira = $cadaOrca['dataemissao'];
			$dataEmissaoBrasileira = date('d/m/Y',  strtotime($dataEmissaoBrasileira));

			if($cadaOrca['status'] == 1){
				$status = "Aberto";
			} else if($cadaOrca['status'] == 2){
				$status = "Fechado";
			} else if($cadaOrca['status'] == 3){
				$status = "Finalizado";
			}

			$html .= "

			<tr class = 'linha1'>
				<th class = 'campoCodigo'>".$cadaOrca['codigo']."</th>
				<th class = 'linhaCliente' colspan = 2>".$cadaOrca['nome']."</th>
				<th class = 'linhasTituloSuperior'>".$dataEmissaoBrasileira."</th>
				<th class = 'linhasTituloSuperior'>".$desconto."</th>
				<th class = 'linhasTituloSuperior'> R$ ".$valorTotal."</th>
			</tr>";
		$valorTotal = "";

			$comando3 = "
		SELECT
			id, nomeProduto, descricaoestampa, precoatual, quantidade, orcamentos.codigo, orcamentos_has_produtos.orcamentos_codigo
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

		$resultado = mysqli_query($conexao, $comando3); 

		$orcamentos2Linha = array();
		while($cadaOrca2 = mysqli_fetch_assoc($resultado)){
			array_push($orcamentos2Linha, $cadaOrca2);
		}

		$html .="

					<tr>
						<td class = 'linhaProdutosEstatica'> Produto </td>
						<td class = 'linhaDescEstatica' colspan = '2'> Descrição </td>
						<td class = 'linhaPrecoEstatico'> Preço </td>
						<td class = 'linhaQtdeEstatica'> Quantidade </td>
					    <td class = 'linhaStatusEstatica'> Status </td>



					</tr>
					";

		foreach($orcamentos2Linha as $cadaOrca2){
			$html .= "

			<tr class = 'linhaTitutloSuperior'>
				<td class = 'linhaProdutos'>".$cadaOrca2['nomeProduto']."</td>
				<td colspan = '2' class = 'linhaDesc'>".$cadaOrca2['descricaoestampa']."</td>
				<td class = 'camposDireita'> R$ ".$cadaOrca2['precoatual']."</td>
				<td  class = 'camposDireita'>".$cadaOrca2['quantidade']."</td>
        <td class = 'linhaStatus'>".$status."</td>

			</tr>
		";


		} 

		$valorTeste = $cadaOrca['codigo'];
		$html2 .= $html;

			echo $html;

			$html = "";

		} 

	}

	} 
	?>

		</table>


<?php
	if($html2 != ""){
?>

			<form action = "generatePDF.php" method = "POST">
			<input type = "hidden" name = "html" value = "<?=$html2;?>">
			<button onclick =  type="submit" id="botaoPdf">
				Gerar PDF
			</button>
		</form>


	<?php
	} else if($html2 == ""){
		echo "";
	}
?>

		</fieldset>


	</main>

</body>
</html>

<?php
  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>