

<header id="cabecalho">
		
		<nav class="menu">
			
		<ul id="menuPrincipal">
			<a href="home.php" class="botaoClique"><img src="../../img/icone.png" id="logo" alt="icone"><li></li></a>
				
			<a href="registroClienteForm.php" class="botaoClique"><li><p>Register Client</p></li></a>
			<a href="registroOrcamentoForm.php" class="botaoClique"><li><p>Budget</p></li></a>
			<a href="consultaOrdemServico.php" class="botaoClique"><li><p>Work Order</p></li></a>
			<li id="campoNome"><p id="nome"><?=$_SESSION['usuarioLogado'];?></p></li>
			<a href="../efetuaLogout.php"><img src="../../img/logout.jpg" id="botaoSair" alt="botão para deslogar o usuário"></a>
		</ul>		
			
		</nav>
		
</header>