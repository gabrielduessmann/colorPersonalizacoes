
<?php

  
  session_start();

    if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {
	

?>


<!DOCTYPE html>

<html lang="pt-br">
<?php $html = ""; ?>
<?php $html1 = ""; ?>
<?php $html2 = ""; ?>
<?php $valorTotal = ""; ?>


<head>
  <title>Diretor - Relatório de Ordens de Serviços</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/diretor/relatorioOrdensServicos.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
  <!-- <script src="../../js/manager/reportWorKOrder.js"></script> -->
</head>

<body>
  <?php
  function calculaValorTotal($codigo, $conexao){

  




  	$sql="SELECT SUM(orcamentos_has_produtos.quantidade*orcamentos_has_produtos.precoatual) as valorTotal 
			 FROM ordensservicos INNER JOIN orcamentos_has_produtos ON ordensservicos.orcamentos_codigo=orcamentos_has_produtos.orcamentos_codigo WHERE ordensservicos.codigo=".$codigo;
//	echo $sql;
  	$resultadoValor=mysqli_query($conexao,$sql);
  	$valorTotal=mysqli_fetch_assoc($resultadoValor);
    return $valorTotal['valorTotal'];
    
  }
  ?>



  <?php include("managerMenuLayout.php");  ?>




	<main id="conteudo">

		<br>

		<h1 id="head">Relatório de Ordens de Serviços</h1>

		<fieldset class="fieldsets">

			<legend class="legends">Filtros</legend>

			<form action="#" method="GET" id="formRelatorioOrdensServicos">

				<div id="esquerda">

				<label for="cliente" class = "palavras">Cliente</label>
				<select id = "cliente" name = "cliente" placeholder = "Selecione">

          <option value="0">Selecione</option>

          <?php
            require_once("../dbConnection.php");
            $comando="SELECT id, nome FROM clientes";
            $resultado=mysqli_query($conexao,$comando);
            $clientes=array();

            while($cadaCli = mysqli_fetch_assoc($resultado)){
              array_push($clientes, $cadaCli);
            }

            foreach($clientes as $cadaCli){
?>

              <option value="<?=$cadaCli['id'];?>"> <?=$cadaCli['nome'];?> </option>
              <?php
            }
            ?>



        </select>

				<br>

				<label for="funcionario" class = "palavras">Customizador</label>
				<select  id = "funcionario" name="funcionario" class="funcionario" placeholder = "Selecione">

            <option value="0">Selecione</option>

            <?php
              require_once("../dbConnetion.php");
              $comando="SELECT id, usuario FROM usuarios 
              INNER JOIN ordensservicos
              ON id=usuarios_id 
              WHERE graupermissao=002
              GROUP BY id";
              $resultado=mysqli_query($conexao,$comando);
              $customizador=array();

              while($cadaCus=mysqli_fetch_assoc($resultado)){
                array_push($customizador, $cadaCus);
              }

              foreach($customizador as $cadaCus){
            ?>
            <option value="<?=$cadaCus['id'];?>"><?=$cadaCus['usuario'];?></option>
            <?php
              }
             ?>

          </select>
				<br>

				<label for="status" class = "palavras">Status</label>
				<select name="status" id="status" class="status">
          <option value="0">Selecione</option>
				  <option value="2">Em Andamento</option>
				  <option value="1">Em Aberto</option>
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
				

				<button type="submit" id = "botaoFiltrar">
          Filtar
				</button>
				

			</form>

		</fieldset>
<fieldset class="fieldsets">
		<table class="tabels">

			<legend class="legends">Relatório</legend>

<table id="relatorioOrdemServico">
  <thead>
    <tr class = "linhaCabecalho">
      <th class = "linhaCodigo">Código</th>
      <th class = "linhaCliente" colspan = "2">Cliente</th>
      <th class = 'dataEmissaoEstatica'> Entrega</th>
      <th class = "linhaFuncionario" >Funcionário</th>
      <th class = "linhaVT">Total</th>
    
    </tr>
  </thead>
			<br><br>


          <?php
            if((isset($_GET['dataInicial'])==true) && (isset($_GET['dataFinal'])==true) &&
            (isset($_GET['cliente'])==true) && (isset($_GET['funcionario'])==true) && (isset($_GET['status'])==true)){
              // echo "foi";
              $dataInicial=$_GET['dataInicial'];
              $dataFinal=$_GET["dataFinal"];
              $cliente=$_GET["cliente"];
              $funcionario=$_GET["funcionario"];
              $status=$_GET["status"];

// echo $dataInicial;
               $dataAtual=date('Y/m/d');
              $dataMinima='1000/01/01';
// echo $dataAtual;
 // echo $cliente;

              if($dataInicial=="" && $dataFinal=="" && $cliente==0 && $funcionario==0 && $status==0){
                $comando="
                SELECT
                usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
            INNER JOIN
              ordensservicos
            ON
              ordensservicos.orcamentos_codigo=orcamentos.codigo GROUP BY ordensservicos.codigo ";

          //     echo $comando;

              }else if($dataInicial!="" && $dataFinal!="" && $cliente!=0 && $funcionario!=0 && $status!=0){

                    $comando="
                    SELECT
                     usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                  	FROM
                  		clientes
                  	INNER JOIN
                  		orcamentos
                  	ON
                  		clientes.id = orcamentos.clientes_id
                  	INNER JOIN
                  		orcamentos_has_produtos
                  	ON
                  		orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                  	INNER JOIN
                  		produtos
                  	ON
                  		orcamentos_has_produtos.produtos_codigo = produtos.codigo
                    INNER JOIN
                      usuarios
                    ON
                      orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                  ordensservicos
                ON
                  ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '$dataInicial' AND '$dataFinal' AND orcamentos.clientes_id='".$cliente."' AND orcamentos.usuarios_id=$funcionario AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                    // echo $comando;
              }else if($dataInicial=="" && $dataFinal=="" && $cliente!=0 && $funcionario==0 && $status==0){
                $comando="
                SELECT
                usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
              INNER JOIN
              ordensservicos
              ON
              ordensservicos.orcamentos_codigo=orcamentos.codigo
              WHERE orcamentos.clientes_id='".$cliente."' GROUP BY ordensservicos.codigo";
                //  echo $comando;
              }else if($dataInicial=="" && $dataFinal=="" && $cliente==0 && $funcionario==0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                  // echo $comando;

             }else if($dataInicial=="" && $dataFinal=="" && $cliente==0 && $funcionario!=0 && $status==0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE orcamentos.usuarios_id='".$funcionario."' GROUP BY ordensservicos.codigo ";
                //  echo $comando;
              }else if($dataInicial=="" && $dataFinal!="" && $cliente==0 && $funcionario==0 && $status==0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataMinima."' AND '".$dataFinal."'  GROUP BY ordensservicos.codigo";
                  // echo $comando;
                 
              }else if($dataInicial!="" && $dataFinal=="" && $cliente==0 && $funcionario==0 && $status==0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, ordensservicos.dataemissao, ordensservicos.dataentrega, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' GROUP BY ordensservicos.codigo ";
                      // echo $comando; AQUIIIIIII
                      // echo $dataInicial;
                      // $dataemissao = ['dataemissao'];
                      // parse_str = $dataemissao
                      // print $dataemissao;
              }else if($dataInicial=="" && $dataFinal=="" && $cliente!=0 && $funcionario!=0 && $status==0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE orcamentos.clientes_id='".$cliente."' AND orcamentos.usuarios_id='".$funcionario."' GROUP BY ordensservicos.codigo";
                    // echo $comando;
              }else if($dataInicial=="" && $dataFinal=="" && $cliente!=0 && $funcionario==0 && $status!=0){
                $comando="
                SELECT
                usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE orcamentos.clientes_id='".$cliente."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                    //  echo $comando;
              }else if($dataInicial!="" && $dataFinal=="" && $cliente!=0 && $funcionario==0 && $status==0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND orcamentos.clientes_id='".$cliente."' GROUP BY ordensservicos.codigo";
                      // echo $comando;
              }else if($dataInicial=="" && $dataFinal!="" && $cliente!=0 && $funcionario==0 && $status==0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataMinima."' AND '".$dataAtual."' AND orcamentos.clientes_id='".$cliente."' GROUP BY ordensservicos.codigo";
                      //  echo $comando;
              }else if($dataInicial=="" && $dataFinal=="" && $cliente==0 && $funcionario!=0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE  orcamentos.usuarios_id='".$funcionario."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                        // echo $comando;
              }else if($dataInicial!="" && $dataFinal=="" && $cliente==0 && $funcionario!=0 && $status==0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND orcamentos.usuarios_id='".$funcionario."' GROUP BY ordensservicos.codigo";
                        //  echo $comando;
              }else if($dataInicial=="" && $dataFinal!="" && $cliente==0 && $funcionario!=0 && $status==0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND orcamentos.usuarios_id='".$funcionario."' GROUP BY ordensservicos.codigo";
                          // echo $comando;
              }else if($dataInicial!="" && $dataFinal=="" && $cliente==0 && $funcionario==0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                          //  echo $comando;
              }else if($dataInicial=="" && $dataFinal!="" && $cliente==0 && $funcionario==0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                            // echo $comando;
              }else if($dataInicial!="" && $dataFinal!="" && $cliente==0 && $funcionario==0 && $status==0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' GROUP BY ordensservicos.codigo";
                            //  echo $comando;
              }else if($dataInicial=="" && $dataFinal=="" && $cliente!=0 && $funcionario!=0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE orcamentos.clientes_id='".$cliente."' AND orcamentos.usuarios_id='".$funcionario."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                              // echo $comando;
              }else if($dataInicial!="" && $dataFinal!="" && $cliente!=0 && $funcionario==0 && $status==0){
                $comando="
                SELECT
                usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND orcamentos.clientes_id='".$cliente."' GROUP BY ordensservicos.codigo";
                              //  echo $comando;
              }else if($dataInicial!="" && $dataFinal=="" && $cliente==0 && $funcionario!=0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND orcamentos.usuarios_id='".$funcionario."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                              //  echo $comando;
              }else if($dataInicial=="" && $dataFinal!="" && $cliente==0 && $funcionario!=0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND orcamentos.usuarios_id='".$funcionario."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                              // echo $comando;
              }else if($dataInicial!="" && $dataFinal!="" && $cliente==0 && $funcionario!=0 && $status==0){
                $comando="
                SELECT
                usuarios.id, usuarios.graupermissao,  clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND orcamentos.usuarios_id='".$funcionario."' GROUP BY ordensservicos.codigo";
                              //  echo $comando;
              }else if($dataInicial!="" && $dataFinal!="" && $cliente==0 && $funcionario==0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                                // echo $comando;
              }else if($dataInicial!="" && $dataFinal=="" && $cliente!=0 && $funcionario==0 && $status!=0){
                $comando="
                SELECT
                usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND ordensservicos.status='".$status."' AND orcamentos.clientes_id='".$cliente."' GROUP BY ordensservicos.codigo";
                                //  echo $comando;
                }else if($dataInicial!="" && $dataFinal=="" && $cliente==0 && $funcionario!=0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND orcamentos.usuarios_id='".$funcionario."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                // echo $comando;

              }else if($dataInicial=="" && $dataFinal!="" && $cliente!=0 && $funcionario==0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND orcamentos.clientes_id='".$cliente."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                //  echo $comando;
              }else if($dataInicial=="" && $dataFinal!="" && $cliente==0 && $funcionario!=0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND orcamentos.usuarios_id='".$funcionario."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                // echo $comando;

              }else if($dataInicial!="" && $dataFinal=="" && $cliente!=0 && $funcionario!=0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataAtual."' AND orcamentos.clientes_id='".$cliente."' AND orcamentos.usuarios_id='".$funcionario."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                //  echo $comando;
              }else if($dataInicial!="" && $dataFinal!="" && $cliente==0 && $funcionario!=0 && $status!=0){
                $comando="
                SELECT
               usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND orcamentos.usuarios_id='".$funcionario."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                  // echo $comando;
              }else if($dataInicial!="" && $dataFinal!="" && $cliente!=0 && $funcionario==0 && $status!=0){
                $comando="
                SELECT
                usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND orcamentos.clientes_id='".$cliente."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                  //  echo $comando;
              }else if($dataInicial!="" && $dataFinal!="" && $cliente!=0 && $funcionario!=0 && $status==0){
                $comando="
                SELECT
                usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataInicial."' AND '".$dataFinal."' AND orcamentos.clientes_id='".$cliente."' AND orcamentos.usuarios_id='".$funcionario."' GROUP BY ordensservicos.codigo";
                    // echo $comando;
              }else if($dataInicial=="" && $dataFinal!="" && $cliente!=0 && $funcionario!=0 && $status!=0){
                $comando="
                SELECT
                 usuarios.id, usuarios.graupermissao, clientes.nome AS nomeCliente, usuarios.nome AS nomeUsuario, ordensservicos.usuarios_id, produtos.preco_unitario, produtos.nomeProduto, orcamentos_has_produtos.quantidade, precoatual, orcamentos.dataemissao, ordensservicos.status, ordensservicos.codigo AS codigoOrdemServico, desconto
                FROM
                  clientes
                INNER JOIN
                  orcamentos
                ON
                  clientes.id = orcamentos.clientes_id
                INNER JOIN
                  orcamentos_has_produtos
                ON
                  orcamentos_has_produtos.orcamentos_codigo = orcamentos.codigo
                INNER JOIN
                  produtos
                ON
                  orcamentos_has_produtos.produtos_codigo = produtos.codigo
                INNER JOIN
                  usuarios
                ON
                  orcamentos.usuarios_id=usuarios.id
                INNER JOIN
                ordensservicos
                ON
                ordensservicos.orcamentos_codigo=orcamentos.codigo
                WHERE ordensservicos.dataemissao BETWEEN '".$dataMinima."' AND '".$dataFinal."' AND orcamentos.clientes_id='".$cliente."' AND orcamentos.usuarios_id='".$funcionario."' AND ordensservicos.status='".$status."' GROUP BY ordensservicos.codigo";
                    
            }
            //  echo $comando;
            $resultado = mysqli_query($conexao, $comando);

          	$linhas = mysqli_num_rows($resultado);
          	$html2 = "";

          	if($linhas == 0){
          	?>
          		<tr> <td colspan = "7"> Nenhuma ordem de serviço encontrada</td> </tr>

          	<?php
          	} // fechamento if linha 355 ($linhas)
          	else {
          		$ordens = array();
          		while($cadaOrdem = mysqli_fetch_assoc($resultado)){
          			array_push($ordens, $cadaOrdem);
          		}

          		$html = "";


          		$valorTotal = "";

          		foreach($ordens as $cadaOrdem){
          		$codigo = $cadaOrdem['codigoOrdemServico'];
                $cliente = $cadaOrdem['nomeCliente'];

      $comando5 = 
      "SELECT usuarios.nome 
      FROM usuarios 
      INNER JOIN ordensservicos 
      ON ordensservicos.usuarios_id = usuarios.id 
      WHERE graupermissao=2 
      AND  ordensservicos.codigo =".$cadaOrdem['codigoOrdemServico'];
			
			$resultado = mysqli_query($conexao, $comando5);
	
			$customizadores = array();
          		while($cadaCust = mysqli_fetch_assoc($resultado)){
          			array_push($customizadores, $cadaCust);
          		}

				foreach($customizadores as $cadaCust){
				 $funcionario = $cadaCust['nome'];
				}
	//		echo $comando5;

		
				$desconto = $cadaOrdem['desconto'];
			    $valorTotal .= calculaValorTotal($cadaOrdem['codigoOrdemServico'], $conexao);
            $valorTotal = $valorTotal*(1-$desconto/100); // dando desconto ao valor total
            $valorTotal =  number_format($valorTotal, 2, ',', '');


                $comando = "SELECT dataentrega FROM ordensservicos WHERE codigo=".$cadaOrdem['codigoOrdemServico'];
                $resultado = mysqli_query($conexao, $comando);
                $data = mysqli_fetch_assoc($resultado);

                $dataEntregaBrasileira = $data['dataentrega'];
          			$dataEntregaBrasileira = date('d/m/Y',  strtotime($dataEntregaBrasileira));
               
                if($cadaOrdem['status'] == 1){
          				$status = "Aberto";
          			} else if($cadaOrdem['status'] == 2){
          				$status = "Fazendo";
          			} else if($cadaOrdem['status'] == 3){
          				$status = "Feito";
                }
          			$html .= "

          			<tr class = 'linha1'>
          				<th class = 'linhaCodigo'>".$cadaOrdem['codigoOrdemServico']."</th>
          				<th class = 'linhaCliente' colspan = '2'>".$cadaOrdem['nomeCliente']."</th>
					    
          				
                  <th class = 'dataEmissao'>".$dataEntregaBrasileira."</th>
                  <th class = 'linhaFunc'>".$funcionario."</th>
                  <th class = 'linhaVT'> R$ ".$valorTotal."</th>
						

                </tr>";
                
          		$valorTotal = "";

          			$comando3 = "
          		SELECT
          			id, nomeProduto, descricaoestampa, precoatual, quantidade, orcamentos.codigo, orcamentos_has_produtos.orcamentos_codigo, ordensservicos.codigo, ordensservicos.status
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
				INNER JOIN
					ordensservicos
				ON
					orcamentos_has_produtos.orcamentos_codigo = ordensservicos.orcamentos_codigo
          		WHERE
          			ordensservicos.codigo =".$cadaOrdem['codigoOrdemServico'];
          		// echo $comando3;
          		$resultado = mysqli_query($conexao, $comando3); // mandando p banco

          		$ordens2Linha = array();
          		while($cadaOrdem2 = mysqli_fetch_assoc($resultado)){
          			array_push($ordens2Linha, $cadaOrdem2);
            	}

				  if($cadaOrdem['status'] == 1){
          				$status = "Aberto";
          			} else if($cadaOrdem['status'] == 2){
          				$status = "Fazendo";
          			} else if($cadaOrdem['status'] == 3){
          				$status = "Feito";
          			}

				
              $html .="

                    <tr>
					  <td class = 'linhaProdutosSuperior'>Produtos</td>
                      <td colspan = '2' class = 'linhaDescEstatica'> Descrição </td>
                      <td class = 'linhaPrecoEstatica'> Preço </td>
                      <td class = 'linhaQtdeEstatica'> Quantidade </td>
                      <td class = 'linhaStatusEstatica'> Status</td>
					  


                    </tr>
                    ";
                    foreach($ordens2Linha as $cadaOrdem2){
                      $html .= "

                      <tr class = 'linhaTitutloSuperior'>
					            <td class = 'linhaProdutos'>".$cadaOrdem2['nomeProduto']."</td>
                        <td class = 'linhaDesc' colspan = '2'>".$cadaOrdem2['descricaoestampa']."</td>
                        <td class = 'camposDireita'> R$  ".number_format($cadaOrdem2['precoatual'], 2, ',', '')."</td>
                        <td  class = 'camposDireita'>".$cadaOrdem2['quantidade']."</td>
                       
                        <td class = 'linhaStatus'>".$status."</td>


                      </tr>
                    ";


                    }

          		} // fechamento foreach linha 367

          		$valorTeste = $cadaOrdem['codigoOrdemServico'];
          		$html2 .= $html;

          			echo $html;

          			$html = "";

          		} // fechamento foreach linha 466

            } // fechamento else linha 361
            // echo $comando5;
          	?>

          		</table>


          <?php
          	if($html2 != ""){
          ?>

          			<form action = "generatePDFWorkOrder.php" method = "POST">
          			<input type = "hidden" name = "html" value = "<?=$html2;?>">
          			<button type="submit" id="botaoPdf">
                  
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


