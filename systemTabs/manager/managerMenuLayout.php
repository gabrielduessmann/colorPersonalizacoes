
<header id="cabecalho">
		
		<nav class="menu">
			
		<ul id="menuPrincipal">
			<a href="principal.php" class="botaoClique"><img src="../../img/icone.png" id="logo" alt="icone"><li id="listaLogo"></li></a>
			<li class="menuDesce">
				<a href="" class="botaoClique"><p class="dropdown">Registers</p></a>
				<ul class="submenu" id="submenu1">
					<a href="clientRegistrationForm.php" class="botaoClique"><li><p>Client</p></li></a>
					<a href="userRegistrationForm.php" class="botaoClique"><li><p>User</p></li></a>
					<a href="productRegistrationForm.php" class="botaoClique"><li><p>Product</p></li></a>
					<a href="categoryRegistrationForm.php" class="botaoClique"><li><p>Category</p></li></a>
				</ul>
			</li>
			<a href="budgetRegistrationForm.php" class="botaoClique"><li><p>Budget</p></li></a>
			<a href="workOrderRegistrationForm.php" class="botaoClique"><li><p>Work Order</p></li></a>
			<li class="menuDesce">
				<a href="" class="botaoClique"><p class="dropdown">Reports</p></a>
				<ul class="submenu" id="submenu2">
					<a href="budgetReport.php" class="botaoClique"><li><p>Budget</p></li></a>
					<a href="workOrderReport.php" class="botaoClique"><li><p>Work Order</p></li></a>
				</ul>
			</li>
			<li id="campoNome"><p id="nome"><?=$_SESSION['usuarioLogado'];?></p></li>
			<a href="../doLogout.php"><img src="../../img/logout.jpg" id="botaoSair"></a>
		</ul>		
			
		</nav>
		
</header>



