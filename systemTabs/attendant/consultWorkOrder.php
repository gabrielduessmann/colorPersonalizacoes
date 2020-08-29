
<?php


session_start();


	if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==3) {


?>

<!DOCTYPE html>

<html lang="pt-br">

<head>
	<title> Atendente - Ordem de Serviço </title>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="../../css/attendant/consultWorkOrder.css">
	<link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
	<script src="../../js/customizer/editWorkOrder.js"></script>
</head>

<body>
		
	<main id = "conteudoPrincipal">
	
<?php


function calculaValorTotal($codigo, $conexao){

	$comando = "SELECT desconto FROM orcamentos WHERE codigo=".$codigo;
	$resultado = mysqli_query($conexao, $comando);
	$resultado = mysqli_fetch_assoc($resultado);
	$desconto = $resultado['desconto'];
	$desconto = intval($desconto);
	

	if ($desconto == "undefined" || $desconto == "" || $desconto == 0) {
		$desconto = 1;
	} else {
		$desconto = intval($desconto);
		$desconto = 1-($desconto/100);
	}
	
	$sql="SELECT SUM(orcamentos_has_produtos.quantidade*orcamentos_has_produtos.precoatual) 
	as valorTotal 
	FROM orcamentos INNER JOIN orcamentos_has_produtos ON 
	orcamentos.codigo=orcamentos_has_produtos.orcamentos_codigo WHERE orcamentos.codigo=".$codigo;
	
	$resultadoValor=mysqli_query($conexao,$sql);
	$valorTotal=mysqli_fetch_assoc($resultadoValor);
	return $valorTotal['valorTotal']*$desconto; 
}

?>
	
	<?php include("attendantMenuLayout.php") ?>
	<br>

	<h1 id = "tituloPag">Ordem de Serviço </h1>
	
	
	<fieldset class="fieldsets">

	<legend class="legends">Consulta de Ordens de Serviço</legend>

		<form action="#" method="GET" id="formConsultaOrdens">

			<label for="buscaCliente" id="palavraBusca">Nome do Cliente</label>
			<input type="text" name="buscaCliente" class="camposTexto" id="buscaCliente" placeholder = "Insira o nome do cliente aqui">

			<button type="submit" class="consulta" id="botaoLupa">
				<img src="../../img/lupa.png" alt="botão pesquisar" id="imgLupa">
			</button>
		
		</form>


<?php

	require_once("../dbConnection.php");

if (isset($_GET['buscaCliente']) && $_GET['buscaCliente']=="") { 	

	
	$comando = 
	"SELECT 
		ordensservicos.codigo, dataentrega, ordensservicos.orcamentos_codigo,  ordensservicos.status, ordensservicos.usuarios_id,
		desconto,
		precoatual, quantidade, 
		clientes.nome AS nomeCliente,	
		usuarios.nome AS nomeUsuario
	FROM 
		orcamentos
	INNER JOIN 
		ordensservicos	
	ON
		ordensservicos.orcamentos_codigo=orcamentos.codigo
	INNER JOIN	
		clientes
	ON 
		orcamentos.clientes_id=id	
	INNER JOIN
		orcamentos_has_produtos
	ON
		orcamentos.codigo=orcamentos_has_produtos.orcamentos_codigo
	INNER JOIN
		usuarios
	ON
		ordensservicos.usuarios_id=usuarios.id 
	GROUP BY 
		orcamentos.codigo";

}
else if (isset($_GET['buscaCliente'])==false){
	$comando = 
		"SELECT 
			ordensservicos.codigo, dataentrega, ordensservicos.orcamentos_codigo,  ordensservicos.status, ordensservicos.usuarios_id,
			desconto,
			precoatual, quantidade, 
			clientes.nome AS nomeCliente,	
			usuarios.nome AS nomeUsuario
		FROM  
			orcamentos
		INNER JOIN 
			ordensservicos	
		ON
			ordensservicos.orcamentos_codigo=orcamentos.codigo
		INNER JOIN	
			clientes
		ON 
			orcamentos.clientes_id=id	
		INNER JOIN
			orcamentos_has_produtos
		ON
			orcamentos.codigo=orcamentos_has_produtos.orcamentos_codigo
		INNER JOIN
			usuarios
		ON
			ordensservicos.usuarios_id=usuarios.id 
		GROUP BY orcamentos_codigo";

}
else if (isset($_GET['buscaCliente']) && $_GET['buscaCliente']!="") {

	$buscaCliente = $_GET['buscaCliente'];
	$comando = 
		"SELECT 
			ordensservicos.codigo, dataentrega, ordensservicos.orcamentos_codigo,  ordensservicos.status, ordensservicos.usuarios_id,
			desconto,
			precoatual, quantidade, 
			clientes.nome AS nomeCliente,	
			usuarios.nome AS nomeUsuario
		FROM 
			orcamentos
		INNER JOIN 
			ordensservicos	
		ON
			ordensservicos.orcamentos_codigo=orcamentos.codigo
		INNER JOIN	
			clientes
		ON 
			orcamentos.clientes_id=id	
		INNER JOIN
			orcamentos_has_produtos
		ON
			orcamentos.codigo=orcamentos_has_produtos.orcamentos_codigo
		INNER JOIN
			usuarios
		ON
			ordensservicos.usuarios_id=usuarios.id
		WHERE
			LOWER(clientes.nome) LIKE '%".$buscaCliente."%' 	
		GROUP BY 
			orcamentos.codigo";
}

	
	$resultado = mysqli_query($conexao, $comando);
	$linhas = mysqli_num_rows($resultado);

?>

<table>
	<thead>
		<tr>
			<th>Código</th>
			<th>Cliente</th>
			<th>Data de Entrega</th>
			<th>Total</th>
			<th>Funcionário Responsável</th>
			<th>Status</th>
			<th>Ação</th>
		</tr>
	</thead>

<?php

if ($linhas==0) {

?>

<tr><td colspan="7" id="semOrdemServico">Nenhuma ordem de serviço cadastrada</td></tr>


<?php

} else {

$ordensServicos = array();
while ($cadaOrdem = mysqli_fetch_assoc($resultado)) {
	array_push($ordensServicos, $cadaOrdem);
}

foreach ($ordensServicos as $cadaOrdem) {
	$quanidade = $cadaOrdem['quantidade'];
	$valorAtual = $cadaOrdem['precoatual'];
	$desconto = $cadaOrdem['desconto'];

	$valorTotal = calculaValorTotal($cadaOrdem['orcamentos_codigo'], $conexao);
	$valorTotal = number_format($valorTotal, 2, ',', ''); //máscara para o valor total

	$dataEntregaBrasileira = $cadaOrdem['dataentrega'];
	$dataEntregaBrasileira = date('d/m/Y', strtotime($dataEntregaBrasileira));

	
	$status = $cadaOrdem['status'];

	switch ($status) { 
		case 1:
			$status = "Aberto";
			break;
		case 2:
			$status = "Fazendo";
			break;
		case 3:
			$status = "Feito";
			break;
	}
	
?>

	<tbody>
		<tr>
			<td><?=$cadaOrdem['codigo'];?></td>
			<td><?=$cadaOrdem['nomeCliente'];?></td>
			<td><?=$dataEntregaBrasileira;?></td>
			<td>R$ <?=$valorTotal;?></td>
			<td><?=$cadaOrdem['nomeUsuario'];?></td>
			<td><?=$status;?></td>

			<td width="5%">
				<form action="viewWorkOrder.php" method="POST">
				<input type="hidden" value="<?=$cadaOrdem['orcamentos_codigo'];?>" name="codigoOrcamento">
					<button type="submit" class="botao" id="botaoVisualizar">
						<img src="../../img/visualizar.png" alt="botão para visualizar a ordeem de serviço" 
						id="imgVisualizar" title="Visualizar Ordem de Serviço">
					</button>
				</form>
			</td>
			</tr>

<?php
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
