
<!DOCTYPE html>

<html lang = "pt-br">


<head>
	<title> Camisas </title>
	<meta charset = "UTF-8">
	<link rel="stylesheet" href="../css/camisas.css">
	<link rel="icon" href="../img/icone.png" type="image/png" sizes="18x18">
</head>

<body>

	<div id = "menu">

		<?php include("websiteMenu.php")?>

		</div>

	<main id="conteudo">

		<h1 id = "tituloPrimario"> EXEMPLOS DE CAMISAS </h1>

		<img id = "linha" src = "../img/linha.png" alt = "Linha de divisão">

		<br>

		<div id = "itemEsquerda">
			<h2 class = "tituloSecundario"> Camisa Batman </h2>
				<img src = "../img/camisa1.jpg" class = "imgCamisas" alt = "Camisa do Batman 80 anos"
					onmouseover="this.src='../img/camisa1Transp.png'" onmouseout="this.src='../img/camisa1.jpg'"/>


			<h2 class = "tituloSecundario"> Camisa Supernatural </h2>
				<img src = "../img/camisa2.jpg" class = "imgCamisas" alt = "Camisa da série Supernatural"
					onmouseover="this.src='../img/camisa2Transp.png'" onmouseout="this.src='../img/camisa2.jpg'"/>
		</div>

		<div id = "itemMeio">
			<h2 class = "tituloSecundario"> Camisa Sharpay HSM </h2>
				<img src = "../img/camisa3.jpg" class = "imgCamisas" alt = "Camisa do filme High School Music"
					onmouseover="this.src='../img/camisa3Transp.png'" onmouseout="this.src='../img/camisa3.jpg'"/>


			<h2 class = "tituloSecundario"> Camisa MARVEL </h2>
				<img src = "../img/camisa4.jpg" class = "imgCamisas" alt = "Camisa do Capitão América em pixels"
					onmouseover="this.src='../img/camisa4Transp.png'" onmouseout="this.src='../img/camisa4.jpg'"/>
		</div>

		<div id = "itemDireita">
			<h2 class = "tituloSecundario"> Camisa Star Wars </h2>
				<img src = "../img/camisa5.jpg" class = "imgCamisas" alt = "Camisa Star Wars stormtrooper"
					onmouseover="this.src='../img/camisa5Transp.png'" onmouseout="this.src='../img/camisa5.jpg'"/>


			<h2 class = "tituloSecundario"> Camisa Riverdale </h2>
				<img src = "../img/camisa6.jpg" class = "imgCamisas" alt = "Camisa das vixens da série Riverdale"
					onmouseover="this.src='../img/camisa6Transp.png'" onmouseout="this.src='../img/camisa6.jpg'"/>
		</div>



	</main>

	<footer id="rodape">
		<p id="copyright">Color Personalizações &copy; 2019</p>
	</footer>

</body>

</html>
