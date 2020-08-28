<?php
  

  	session_start();

  		if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {



	include ("mpdf/mpdf.php");

	$relatorio = $_POST['html'];

		$mpdf = new mPDF();
		$mpdf-> SetDisplayMode("fullpage");
		$mpdf-> WriteHTML("

	<style>

		  h1{
          text-align: center;
		  color: #4682B4;
          }

		   table{
			  width: 100%;
			  text-align: center;
		  }

		  th{
			  background-color: #4682B4;
			  height: 40px;
			  width: 16%;
		  }

		  td{
			  background-color: #ADD8E6;
			  height: 40px;

		  }

		   .campoCodigo{
			  width: 25%;
		  }

		  .linhaProdutos{
		width: 25%;
		background-color: #ADD8E6;
	}



	</style>

		<h1> Relatório de Orçamentos </h1>

			<table>
			<tr>
				<th id = 'campoCodigo'> Código </th>
				<th> Cliente </th>
				<th> Emissão </th>
				<th> Desconto </th>
				<th> Total </th>
			</tr>	
			<tr>

			".$relatorio."

			</tr>
			</table>
		");

	$mpdf-> Output();
	exit();


  }else {
    header("Location: ../../websiteTabs/login.php");
  }
 ?>