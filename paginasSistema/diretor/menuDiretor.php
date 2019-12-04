
<header id="cabecalho">
		
		<nav class="menu">
			
		<ul id="menuPrincipal">
			<a href="principal.php" class="botaoClique"><img src="../../img/icone.png" id="logo" alt="icone"><li id="listaLogo"></li></a>
			<li class="menuDesce">
				<a href="" class="botaoClique"><p class="dropdown">Registros</p></a>
				<ul class="submenu" id="submenu1">
					<a href="registroClienteForm.php" class="botaoClique"><li><p>Cliente</p></li></a>
					<a href="registroUsuarioForm.php" class="botaoClique"><li><p>Usuário</p></li></a>
					<a href="registroProdutoForm.php" class="botaoClique"><li><p>Produto</p></li></a>
					<a href="registroCategoriaForm.php" class="botaoClique"><li><p>Categoria</p></li></a>
				</ul>
			</li>
			<a href="registroOrcamentoForm.php" class="botaoClique"><li><p>Orçamento</p></li></a>
			<a href="registroOrdemServicoForm.php" class="botaoClique"><li><p>Ordem de serviço</p></li></a>
			<li class="menuDesce">
				<a href="" class="botaoClique"><p class="dropdown">Relatórios</p></a>
				<ul class="submenu" id="submenu2">
					<a href="relatorioOrcamentos.php" class="botaoClique"><li><p>Orçamento</p></li></a>
					<a href="relatorioOrdensServicosForm.php" class="botaoClique"><li><p>Ordem de serviço</p></li></a>
				</ul>
			</li>
			<li id="campoNome"><p id="nome"><?=$_SESSION['usuarioLogado'];?></p></li>
			<a href="../efetuaLogout.php"><img src="../../img/logout.jpg" id="botaoSair"></a>
		</ul>		
			
		</nav>
		
</header>



