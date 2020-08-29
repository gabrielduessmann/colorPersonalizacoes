function validarCampos(){
	
	var nome = document.getElementById("nomeCompleto").value;
	var cpf = document.getElementById("cpf").value;
	var cnpj = document.getElementById("cnpj").value;
	var inscEstadual = document.getElementById("inscricaoEstadual").value;
	var fone = document.getElementById("fone1").value;
	var celular = document.getElementById("fone2").value;
	var email = document.getElementById("email").value;
	var cep = document.getElementById("cep").value;
	var estado = document.getElementById("estado").value;	
	var cidade = document.getElementById("cidade").value;
	var bairro = document.getElementById("bairro").value;
	var rua = document.getElementById("rua").value;
	var numero = document.getElementById("numero").value;
	
	var aviso = "";
	var verificaFocus = false;
	
	
	if((cpf == "") && (cnpj == "")){
		aviso += "CNPJ ou CPF \n";
		document.getElementById("cnpj").focus();
		verificaFocus = true;
		document.getElementById("cnpj").value="";
	}
	
	if((cnpj != "") && (inscEstadual == "")){
		aviso += "Inscrição Estadual necessário caso use CNPJ \n";
		document.getElementById("inscricaoEstadual").focus();
		verificaFocus = true;
		document.getElementById("inscricaoEstadual").value="";
	}
	
	var nomeSplit = nome.split(" ");
	if (nomeSplit.length == 1) {
		aviso += "Nome completo \n";
		document.getElementById("nomeCompleto").focus();
		verificaFocus = true;
		document.getElementById("nomeCompleto").value="";
	}
	
	if((fone.length != 13) && (fone != "") || (fone == "")){
		aviso += "Telefone \n";
		document.getElementById("fone1").focus();
		verificaFocus = true;
		document.getElementById("fone1").value="";
	}
	
	if((celular.length != 14) && (celular != "")){
		aviso += "Celular \n";
		document.getElementById("fone2").focus();
		verificaFocus = true;
		document.getElementById("fone2").value="";
	}		
	
if (email == "" || email.indexOf("@") == -1 || email.indexOf(".") == -1 || email.indexOf(".")==0 || email.indexOf("@")==0) {
		aviso += "E-mail \n";
		if (verificaFocus == false) {
			document.getElementById("email").focus();
			verificaFocus = true;	
		}
		document.getElementById("email").value="";
	}
	
	if(cep.length != 9){
		aviso += "CEP \n";
		if (verificaFocus == false) {
			document.getElementById("cep").focus();
			verificaFocus = true;	
		}
		document.getElementById("cep").value="";
	}
	
	if (estado != "AC" && estado != "AL" && estado != "AP" && estado != "AM" && estado != "BA" && estado != "CE" && estado != "DF" && estado != "ES" 
	&& estado != "GO" && estado != "MA" && estado != "MT" && estado != "MS" && estado != "MG" && estado != "PA" && estado != "PB" && estado != "PR" 
	&& estado != "PE" && estado != "PI" && estado != "RR" && estado != "RO" && estado != "RJ" && estado != "RN" && estado != "RS" && estado != "SC" 
	&& estado != "SP" && estado != "SE" && estado != "TO") {
		
		aviso += "Estado \n";
		if (verificaFocus == false) {
			document.getElementById("estado").focus();
			verificaFocus = true;	
		}
		document.getElementById("estado").value="";
	}
	
	if(cidade == ""){
		aviso += "Cidade \n";
		if (verificaFocus == false) {
			document.getElementById("cidade").focus();
			verificaFocus = true;	
		}
		document.getElementById("cidade").value="";
	}
	
	if(bairro == ""){
		aviso += "Bairro \n";
		if (verificaFocus == false) {
			document.getElementById("bairro").focus();
			verificaFocus = true;	
		}
		document.getElementById("bairro").value="";		
	}
	
	if(rua == ""){
		aviso += "Rua \n";
		if (verificaFocus == false) {
			document.getElementById("rua").focus();
			verificaFocus = true;	
		}
		document.getElementById("rua").value="";	
	}
	
	if(numero == ""){
		aviso += "Número \n";
		if (verificaFocus == false) {
			document.getElementById("numero").focus();
			verificaFocus = true;	
		}
		document.getElementById("numero").value="";	
	}
	
	if (aviso == "") {
		alert ("Cliente registrado.");
		return true;
	} else {
		alert ("Preencha corretamente o(s) dado(s) a seguir: \n"+aviso);
		return false;
	}
}

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
