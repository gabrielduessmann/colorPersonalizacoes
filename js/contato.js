function validarCampos() {
	
	var nome = document.getElementById("nome").value;
	var email = document.getElementById("email").value;
	var mensagem = document.getElementById("mensagem").value;
	var telefone = document.getElementById("telefone").value;
	var motivoContato = document.getElementById("motivoContato").value
	var aviso = "";
	var verificaFocus = false;
	
	var nomeSplit = nome.split(" ");
	if (nomeSplit.length == 1) {
		aviso += "Nome completo \n";
		document.getElementById("nome").focus();
		verificaFocus = true;
		document.getElementById("nome").value="";
	}
	
if (email == "" || email.indexOf("@") == -1 || email.indexOf(".") == -1 || email.indexOf(".")==0 || email.indexOf("@")==0) {
		aviso += "E-mail \n";
		if (verificaFocus == false) {
			document.getElementById("email").focus();
			verificaFocus = true;	
		}
		document.getElementById("email").value="";
	}
	
	if (motivoContato == 0) {
		aviso += "Motivo para o contato \n";
		if (verificaFocus == false) {
			document.getElementById("motivoContato").focus();
			verificaFocus = true;	
		}
	}
	
	if (mensagem == "") {
		aviso += "Mensagem \n";
		if (verificaFocus == false) {
			document.getElementById("mensagme").focus();
			verificaFocus = true;	
		}
	}
	
	if (telefone == "" || telefone.length < 14) {
		aviso += "Telefone \n";
		if (verificaFocus == false) {
			document.getElementById("telefone").focus();
			verificaFocus = true;	
		}
		document.getElementById("telefone").value="";
	}
	

	
	switch (motivoContato) {
		case 1: 
			motivoCotntato = "Elogio";
			break;
		case 2: 
			motivoCotntato = "Reclamação";
			break;
		case 3: 
			motivoCotntato = "Opinião";
			break;
	}
	
	
	if (aviso == "") {
		alert ("Mensagem enviada.");
		return true;
	} else {
		alert ("Preencha corretamente o(s) dado(s) a seguir: \n"+aviso);
		return false;
	}
}