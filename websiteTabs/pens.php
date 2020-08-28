<!DOCTYPE html>

<html lang = "pt-br">

<head>
	<title> Canetas </title>
	<meta charset = "UTF-8">
	<link rel="stylesheet" href="../css/canetas.css">
	<link rel="icon" href="../img/icone.png" type="image/png" sizes="18x18">
</head> 

<body>

	<div id = "menu">

		<?php include("websiteMenu.php")?>

	</div>
		
	<main id="conteudo">
		
		<h1 id = "tituloPrimario"> EXEMPLOS DE CANETAS </h1>
		
		<img id = "linha" src = "../img/linha.png" alt = "Linha de divisão">
		
		<br>
		
		<div id = "itemEsquerda">
			<h2 class = "tituloSecundario"> Caneta Brilho </h2>
				<img src = "../img/caneta1.jpg" class = "imgCanetas" alt = "Caneta brilho colorida"
					onmouseover="this.src='../img/caneta1Transp.png'" onmouseout="this.src='../img/caneta1.jpg'"/>
				
			
			<h2 class = "tituloSecundario"> Caneta Fofa Gatinho </h2>
				<img src = "../img/caneta4.jpg" class = "imgCanetas" alt = "Caneta com gatinhos"
					onmouseover="this.src='../img/caneta4Transp.png'" onmouseout="this.src='../img/caneta4.jpg'"/>
			
		</div>

		<div id = "itemMeio">
			<h2 class = "tituloSecundario"> Caneta Fina </h2>
				<img src = "../img/caneta2.jpg" class = "imgCanetas" alt = "Caneta fina prateada"
					onmouseover="this.src='../img/caneta2Transp.png'" onmouseout="this.src='../img/caneta2.jpg'"/>
					
				
			<h2 class = "tituloSecundario"> Caneta Estampada </h2>
				<img src = "../img/caneta5.jpg" class = "imgCanetas" alt = "Caneta que é possível estampar"
					onmouseover="this.src='../img/caneta5Transp.png'" onmouseout="this.src='../img/caneta5.jpg'"/>		
		</div>
		
		<div id = "itemDireita">
			<h2 class = "tituloSecundario"> Caneta Seringa </h2>
				<img src = "../img/caneta3.png" class = "imgCanetas" alt = "Caneta em forma de seringa"
					onmouseover="this.src='../img/caneta3Transp.png'" onmouseout="this.src='../img/caneta3.png'"/>
				
			
			<h2 class = "tituloSecundario"> Caneta Cactus </h2>
				<img src = "../img/caneta6.jpg" class = "imgCanetas" alt = "Caneta em forma de cactus em diversas cores"
					onmouseover="this.src='../img/caneta6Transp.png'" onmouseout="this.src='../img/caneta6.jpg'"/>
		</div>
		
		
	
	</main>
	
	<footer id="rodape">
		<p id="copyright">Color Personalizações &copy; 2019</p>
	</footer>
	
</body>

</html>