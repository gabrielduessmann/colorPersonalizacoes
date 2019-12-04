function validarCampos(){
	
	var nomeProduto = document.getElementById("nomeProduto").value;
	var precoProduto = document.getElementById("preco").value;
	var categoria = document.getElementById("categoria").value;
	var aviso = "";
	var verificaFocus = false;	

	if (nomeProduto == "") {
		aviso += "Nome \n";
		if (verificaFocus == false) { 				
		document.getElementById("nomeProduto").focus();
		verificaFocus = true;
		document.getElementById("nomeProduto").value="";
		}
	}	

	if (precoProduto == "") {
		aviso += "Preço \n";
		if (verificaFocus == false)
		document.getElementById("preco").focus();
		verificaFocus = true;
		document.getElementById("preco").value="";
		
		document.getElementById("preco").addEventListener("change", function(){
		this.value = parseFloat(this.value).toFixed(2);
});	
	}	
	if (categoria == 0) {
		aviso += "Categoria  \n";
		if (verificaFocus == false)
		document.getElementById("categoria").focus();
		verificaFocus = true;
		document.getElementById("categoria").value=0;
	}		
	
	
	if (aviso == "") {
		alert ("Produto registrado.");
		return true;
	} else {
		alert ("Preencha corretamente o(s) dado(s) a seguir: \n"+aviso);
		return false;
	}	
}

function validarConsulta(){
	
	var consultaProdutos = document.getElementById("consultaProdutos").value;
	var aviso = "";
	var verificaFocus = false;		

	if (consultaProdutos== "") {
		aviso += "Produto não encontrado. \n";
		document.getElementById("consultaProdutos").focus();
		verificaFocus = true;
		document.getElementById("consultaProdutos").value="";
	}

		
	
	if (aviso == "") {
		return true;
	} else {
		alert (""+aviso);
		return false;
	}		
}
