
<?php


	session_start();

		if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==2) {

?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title> Customizador - Ordem de Serviço </title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/customizer/editWorkOrder.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
  <script src="../../js/customizer/editWorkOrder.js"></script>
</head>

<body>

	<main id = "conteudoPrincipal">

	<?php include("customizerMenuLayout.php") ?>

	<br>
	<h1 id = "tituloPag">Ordem de Serviço </h1>

	<fieldset class = "fieldset">

	<legend class = "legend"> Ordens de Serviço </legend>



	<div id="aberto">

		<h2>Em aberto</h2>

		<table>

			<tr>
				<th>Código</th>
				<th>Cliente</th>
				<th class="produtos">Produtos</th>
				<th class="entrega">Entrega</th>
				<th>Ações</th>
			</tr>


	<?php
		
		require_once("../dbConnection.php");
		$comando = 
		"SELECT 
			ordensservicos.codigo, ordensservicos.dataentrega, nome, 
			orcamentos.codigo AS codigoOrcamento
		FROM
			ordensservicos
		INNER JOIN
			orcamentos	
		ON
			orcamentos.codigo=orcamentos_codigo
		INNER JOIN
			clientes
		ON
			id=clientes_id
		WHERE 
			ordensservicos.status=1	 
		ORDER BY
			ordensservicos.dataentrega ASC	
			 ";
		$resultado = mysqli_query($conexao, $comando);
		$ordemAberta = array();
		while ($cadaOrdemAberta = mysqli_fetch_assoc($resultado)) {
			array_push($ordemAberta, $cadaOrdemAberta);
		}

		$dataAtual = date('Y-m-d');

		$linhas = mysqli_num_rows($resultado);

		if ($linhas==0) {
	?>

				<tr><td colspan="5">Sem Ordem de Serviço</td></tr>

	<?php

		} else {
			
			foreach ($ordemAberta as $cadaOrdemAberta) {

				$comando2 = 
				"SELECT 
					SUM(quantidade) AS qtdeProdutos
				FROM
					orcamentos_has_produtos
				WHERE
					orcamentos_codigo=".$cadaOrdemAberta['codigoOrcamento'];
				$resultado2 = mysqli_query($conexao, $comando2);
				$qtdeProdutos = mysqli_fetch_assoc($resultado2);

				$dataEntregaBrasileira = $cadaOrdemAberta['dataentrega'];
				$dataEntregaBrasileira = date('d/m/Y', strtotime($dataEntregaBrasileira));
					
	?>

				<tr class="dataEntregaPassou">

					<td><?=$cadaOrdemAberta['codigo'];?></td>
					<td><?=$cadaOrdemAberta['nome'];?></td>
					<td><?=$qtdeProdutos['qtdeProdutos'];?></td>
	<?php
					if ($cadaOrdemAberta['dataentrega'] < $dataAtual) {
	?>
					<td class="dataEntregaPassou"><?=$dataEntregaBrasileira;?></td>
	<?php
				} else if ($cadaOrdemAberta['dataentrega'] == $dataAtual) {
	?>
					<td class="dataEntregaHoje"><?=$dataEntregaBrasileira;?></td>	
	<?php
				} else {
	?>
					<td><?=$dataEntregaBrasileira;?></td>	
	<?php
				}
	?>
					<td width="16%">
						<form action="viewWorkOrder.php" method="POST"> 
							<input type="hidden" name="codigoOrdemServico" value="<?=$cadaOrdemAberta['codigo'];?>">
							<button type="submit">
								<img src="../../img/visualizar.png" class="imgVisualizar" title="visualizar">
							</button>
						</form>
						<form action="editWOrkOrderStatusToDoing.php" method="POST"> 
							<input type="hidden" name="codigoOrdemServico" value="<?=$cadaOrdemAberta['codigo'];?>">
							<button type="submit">
								<img src="../../img/customizar.png" id="imgCustomizar" title="finalizar">
							</button>
						</form>
					</td>
				</tr>

	<?php
	
			}
		}
	
	?>

			

		</table>
	</div>


	<div id="fazendo">

		<h2>Fazendo</h2>	

		<table>

			<tr>
				<th>Código</th>
				<th>Cliente</th>
				<th class="produtos">Produtos</th>
				<th class="entrega">Entrega</th>
				<th>Ações</th>
			</tr>


	<?php
		
		require_once("../dbConnection.php");
		
		$comando = 
		"SELECT 
			ordensservicos.codigo, ordensservicos.dataentrega, clientes.nome, 
			orcamentos.codigo AS codigoOrcamento
		FROM
			ordensservicos
		INNER JOIN
			orcamentos	
		ON
			orcamentos.codigo=orcamentos_codigo
		INNER JOIN
			clientes
		ON
			id=clientes_id
		INNER JOIN
			usuarios
		ON
			usuarios.id=ordensservicos.usuarios_id
		WHERE 
			usuarios.id=".$_SESSION['idLogado']." AND ordensservicos.status=2
		ORDER BY
			ordensservicos.dataentrega ASC";
		$resultado = mysqli_query($conexao, $comando);
		$ordemAberta = array();
		while ($cadaOrdemAberta = mysqli_fetch_assoc($resultado)) {
			array_push($ordemAberta, $cadaOrdemAberta);
		}

		$linhas = mysqli_num_rows($resultado);

		if ($linhas==0) {
	?>

				<tr><td colspan="5">Sem Ordem de Serviço</td></tr>

	<?php

		} else {
			
			foreach ($ordemAberta as $cadaOrdemAberta) {

				$comando2 = 
				"SELECT 
					SUM(quantidade) AS qtdeProdutos
				FROM
					orcamentos_has_produtos
				WHERE
					orcamentos_codigo=".$cadaOrdemAberta['codigoOrcamento'];
				$resultado2 = mysqli_query($conexao, $comando2);
				$qtdeProdutos = mysqli_fetch_assoc($resultado2);

				$dataEntregaBrasileira = $cadaOrdemAberta['dataentrega'];
				$dataEntregaBrasileira = date('d/m/Y', strtotime($dataEntregaBrasileira));


					
	?>

				<tr>

					<td><?=$cadaOrdemAberta['codigo'];?></td>
					<td><?=$cadaOrdemAberta['nome'];?></td>
					<td><?=$qtdeProdutos['qtdeProdutos'];?></td>
	<?php
					if ($cadaOrdemAberta['dataentrega'] < $dataAtual) {
	?>
					<td class="dataEntregaPassou"><?=$dataEntregaBrasileira;?></td>
	<?php
				} else if ($cadaOrdemAberta['dataentrega'] == $dataAtual) {
	?>
					<td class="dataEntregaHoje"><?=$dataEntregaBrasileira;?></td>	
	<?php
				} else {
	?>
					<td><?=$dataEntregaBrasileira;?></td>	
	<?php
				}
	?>
					<td width="22%">
						<form action="viewWorkOrder.php" method="POST"> 
							<input type="hidden" name="codigoOrdemServico" value="<?=$cadaOrdemAberta['codigo'];?>">
							<button type="submit">
								<img src="../../img/visualizar.png" class="imgVisualizar" title="visualizar">
							</button>
						</form>
						<form action="editWorkOrderStatusToDone.php" method="POST"> 
							<input type="hidden" name="codigoOrdemServico" value="<?=$cadaOrdemAberta['codigo'];?>">
							<button type="submit">
								<img src="../../img/correto.png" id="imgFinalizar" title="finalizar">
							</button>
						</form>
						<form action="cancelWorkOrder.php" method="POST"> 
							<input type="hidden" name="codigoOrdemServico" value="<?=$cadaOrdemAberta['codigo'];?>">
							<button type="submit">
								<img src="../../img/rejeitar.png" id="imgRejeitar">
							</button>
						</form>
					</td>

				</tr>

	<?php

				

	
			}
		}
	
	?>

		</table>
	</div>




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
