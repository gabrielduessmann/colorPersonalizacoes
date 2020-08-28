<?php
  

  session_start();

  if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {


 ?>



<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title> Diretor - Orçamento </title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/diretor/registroOrcamento.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
  <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"> </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
  <script src="../../js/manager/editBudget.js"></script>
</head>

<body>

<?php


	function mostraClientes($conexao, $codigoOrcamento) {
		
		$comando = 
		"SELECT id, nome 
		FROM clientes";
		$resultado = mysqli_query($conexao, $comando);
		$clientes = array();
		while ($cadaCliente = mysqli_fetch_assoc($resultado)) {
			array_push($clientes, $cadaCliente);
		}
		
		$comando2 = "SELECT clientes_id FROM orcamentos WHERE codigo=".$codigoOrcamento;
		echo $comando2;
		$resultado2 = mysqli_query($conexao, $comando2);
		$clienteOrcamento = mysqli_fetch_assoc($resultado2);

		$opcoesCliente = "";

		foreach ($clientes as $cadaCliente) {
			
			if ($cadaCliente['id'] == $clienteOrcamento['clientes_id']) {
				$opcoesCliente .= "<option selected value='".$cadaCliente['id']."'>".$cadaCliente['nome']."</option>";
			} else {
				$opcoesCliente .= "<option value='".$cadaCliente['id']."'>".$cadaCliente['nome']."</option>";
			}

		}
		return $opcoesCliente;
	}

	
?>
	<?php include("managerMenuLayout.php"); ?>	

	<main id="conteudo">	
			
	<br>
	<h1 id = "tituloPag">Orçamento </h1>
		
	<fieldset class = "fieldset">

	<legend class = "legend"> Orçamento </legend>
				
	
	<form action="editBudget.php" method="POST"  onsubmit="return validarCampos()" id="formOrcamento">



<?php

    require_once("../dbConnection.php");

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


		<label for = "clientes" class = "palavras">Cliente * </label>	
			<select name="clientes" id="clientes" class="inputs">
				<?=mostraClientes($conexao, $codigoOrcamento);?>
			</select>
				
		
		<br><br>
	
		<label for = "listaDeParcelas" class = "palavras"> Parcelas </label>
			<input list = "listaParcelas" name="parcelas" id = "parcelas" class="inputs" 
			onblur="parcelaValor()" value="<?=$parcelas;?>">
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
            <?php
            if ($orcamento['desconto']==NULL) {
            ?>
                <input type = "text" name = "desconto" id = "desconto" class="inputs" placeholder="ex: 50" onblur="descontoValorTotal()">
            <?php
            } else {
            ?>   
                <input type = "text" name = "desconto" id = "desconto" class="inputs" value="<?=$orcamento['desconto']?>" 
                onblur="descontoValorTotal()">
            <?php
            }
            ?>
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
	
</div>

<div id = "pontoDeEntrega">	

<?php
if ($orcamento['cep'] == NULL) { // entregar no local do cliente
?>		

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

<?php
} else { // entregar em outro local
?>

		<label for = "cep" class = "localEntrega"> CEP * </label>
			<input type = "text" name = "cep" id = "cep" class = "campoTexto" placeholder = "Insira seu CEP aqui" 
            value="<?=$orcamento['cep'];?>">
		<br>
		
		<script type="text/javascript">$("#cep").mask("00000-000"); </script>
				
		<label for = "estado" class = "localEntrega"> Estado * </label>
			<input list = "listaEstados" name="estado" id = "estado" class = "campoTexto" placeholder = "Selecione o estado aqui" 
            maxlength = "2" value="<?=$orcamento['estado'];?>">
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
			placeholder = "Insira sua cidade aqui" value="<?=$orcamento['cidade'];?>">
		<br>
				
		<label for = "bairro" class = "localEntrega"> Bairro * </label> 
			<input type = "text" name = "bairro" id = "bairro" class = "campoTexto" placeholder = "Insira seu bairro aqui"
            value="<?=$orcamento['bairro'];?>">
		<br>
				
		<label for = "rua" class = "localEntrega"> Rua * </label>
			<input type = "text" name = "rua" id = "rua" class = "campoTexto" placeholder = "Insira sua rua aqui" 
            value="<?=$orcamento['rua'];?>">
		<br>
				
		<label for = "numero" class = "localEntrega"> Número *</label>
			<input type = "text" name = "numero" id = "numero" class = "campoTexto" placeholder = "Insira seu número de casa aqui"
            value="<?=$orcamento['numero'];?>">

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

<?php
	$valorTotal=0;
	$cont = 0;
    foreach ($produtosOrcamento as $cadaProdutoOrcamento) {	

?>
		<tr id=<?="linha".$cont;?>>
			<td>
				<select name="categorias" id="<?="categorias".$cont;?>" class="categorias" 
				onchange="retornaProdutos(<?=$cont;?>)">
					<?=mostraCategorias($conexao);?>
				</select>
			</td>

			<td>
				<select name="produtos[]"  id="<?="produtos".$cont;?>"  class="produtos" 
				onchange="retornaValorUnitario(<?=$cont;?>)">
                    <?php
                        $comando = "SELECT codigo, nomeProduto FROM produtos";
                        $resultado = mysqli_query($conexao, $comando);
                        $produtos=array();
                        
                        while ($cadaProduto = mysqli_fetch_assoc($resultado)) {
                            array_push($produtos, $cadaProduto);
                        }

                        foreach ($produtos as $cadaProduto) {
                            if ($cadaProduto['codigo'] == $cadaProdutoOrcamento['codigo']) {

                    ?>
                            <option selected="selected" value="<?=$cadaProduto['codigo'];?>"><?=$cadaProduto['nomeProduto'];?></option>    
                    <?php
                            } else {
                    ?>
                            <option value="<?=$cadaProduto['codigo'];?>"><?=$cadaProduto['nomeProduto'];?></option>
                    <?php
                            }
                        }
                    
                    ?>
				</select>
			</td>

			<td>
				<input type="text" required class="vlUnitario" id="<?="vlUnitario".$cont;?>" 
                name="valoresUnitarios[]" readonly="readonly" value="<?=$cadaProdutoOrcamento['precoatual'];?>">
			</td>

			<td>
				<input required type="number" name="qtdeProdutos[]" class="qtde" onblur="atualizaValorTotal(<?=$cont;?>)" 
                id="<?="qtde".$cont;?>" min="1" value="<?=$cadaProdutoOrcamento['quantidade'];?>">
			</td>

			<td>
				<input type="text" class="desc" id="<?="desc".$cont;?>" name="descs[]" value="<?=$cadaProdutoOrcamento['descricaoestampa'];?>">
			</td>

			<td>

			<?php
				if ($cont==0) {
			?>
				<button type="button" class="botaoMais" id="primeiroBotaoMais" onclick="adicionaProduto()">
					<img src="../../img/botaoMais.png" alt="botão para adicionar mais um produto" class="imgMais">
				</button>
			
			<?php
				} else {
			?>
				<button type="button" class="botaoMais" onclick="adicionaProduto()">
					<img src="../../img/botaoMais.png" alt="botão para adicionar mais um produto" class="imgMais">
				</button>
				<button type="button" class="botaoMenos" onclick="removeProduto(<?=$cont;?>)">
					<img src="../../img/botaoMenos.png" alt="botão para remover um produto" class="imgMenos">
				</button>

			<?php
				}
			?>

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
			<input type="number" name="valorTotal" id="valorTotal" value="<?=$valorTotal;?>" readonly="readonly"><br>

		<label class="valorCadaParcela" id="labelCadaParcela"> Valor Cada Parcela</label>
			<input type="number" class="valorCadaParcela" name="valorCadaParcela" id="valorCadaParcela" value="<?=$valorParcelado;?>" 
			readonly="readonly">
		<br>
		
		<button type = "submit" id = "botaoFazerOrcamento"> 
		 	Editar Orçamento
		</button>


</div>

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