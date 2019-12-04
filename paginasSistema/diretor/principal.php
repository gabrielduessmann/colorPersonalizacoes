
<?php
  

  session_start();

    if (isset($_SESSION['idLogado']) && $_SESSION['nivelLogado']==1) {


 ?>


<!DOCTYPE html>

<html lang="pt-br">

<head>
  <title>Diretor - Principal</title>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="../../css/diretor/principal.css">
  <link rel="icon" href="../../img/icone.png" type="image/png" sizes="18x18">
</head>

<body>
		
<?php include("menuDiretor.php");?>

	<main id="conteudo">
  
  <div id="bemvindo">


		Bem-Vindo(a),
    <br><br>
    
		<p id="nomeUsuario">

	<?php
	
		require_once("../conexaoBanco.php");

		$comando = "SELECT nome FROM usuarios WHERE id=".$_SESSION['idLogado'];
		$resultado = mysqli_query($conexao, $comando);
		$usuario = mysqli_fetch_assoc($resultado);
		
		echo $usuario['nome'];

	?>
    </p>
    
		</div>


	</main>


</body>
</html>

<?php
  }else {
    header("Location: ../../paginasSite/entrar.php");
  }
 ?>