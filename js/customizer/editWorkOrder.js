function validarConsulta(){
	
	var nome = document.getElementById("campoNomeCliente").value;
	var aviso = "";
	var verificaFocus = false;
	
	var nomeSplit = nome.split(" ");
	if (nomeSplit.length == 1) {
		aviso += "Nome informado incorretamente";
		document.getElementById("campoNomeCliente").focus();
		verificaFocus = true;
		document.getElementById("campoNomeCliente").value="";
	}
	
	if (aviso == "") {
		return true;
	} else {
		alert ("Cliente não encontrado.");
		return false;
	}
	
}