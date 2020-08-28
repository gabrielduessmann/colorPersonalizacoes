function validarCampos(){
	
	var orcamento = document.getElementById("orcamento").value;
	var dataEntrega = document.getElementById("dataEntrega").value;
	var funcionario = document.getElementById("funcionario").value;
	var aviso="";
	var verificaFocus = false;
	
	if (orcamento == 1 || orcamento == "") {
		aviso += "Orçamento \n";
		if (verificaFocus == false) { 					
		document.getElementById("orcamento").focus();
		verificaFocus = true;
		document.getElementById("orcamento").value="";
		}
	}	
	
	if (funcionario == 1 || funcionario == "") {
		aviso += "Customizador \n";
		if (verificaFocus == false) { 					
		document.getElementById("funcionario").focus();
		verificaFocus = true;
		document.getElementById("funcionario").value="";
		}
	}
	
	if(dataEntrega==""){
		aviso+="Data de entrega\n";
		if (verificaFocus == false) { 					
		document.getElementById("dataEntrega").focus();
		verificaFocus = true;
		document.getElementById("dataEntrega").value="";
		}
	}

	
	
	if(aviso==""){
		alert("Ordem de serviço registrado.")
		return true;
	}else if(aviso!=""){
		alert("Preencha corretamente o(s) dado(s) a seguir: \n"+aviso);
		return false;
	}

}

function validarConsulta(){
	
	var nome = document.getElementById("inputCliente").value;
	
	if(nome==""){
		alert("Ordem de serviço não encontrada.");
		return false;
	}else{
		return true;
	}
	
}



// registraOrdemServicoForm.php

function validarCamposOrdemServico() {
	var dataEntrega = document.getElementById("campoDataEntrega").value;
	// alert (dataEntrega);

	if (dataEntrega == "") {
		alert ("Preencha corretamente a data de entrega.");
		document.getElementById("campoDataEntrega").focus();
		return false;
	} else {
		alert ("Ordem de serviço realizada com sucesso.")
	}
}