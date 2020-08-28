function validarCampos() {

	var nome = document.getElementById("nome").value;
	var cpf = document.getElementById("cpf").value;
	var email = document.getElementById("email").value;
	var aviso = "";
	var verificaFocus = false;

	var nomeSplit = nome.split(" ");
	if (nomeSplit.length == 1) {
		aviso += "Nome completo \n";
		document.getElementById("nome").focus();
		verificaFocus = true;
		document.getElementById("nome").value="";
	}

	if (cpf.length != 14) {
		aviso += "CPF \n";
		if (verificaFocus == false) {
			document.getElementById("cpf").focus();
			verificaFocus = true;
		}
		document.getElementById("cpf").value="";
	}

	if (email == "" || email.indexOf("@") == -1 || email.indexOf(".") == -1 || email.indexOf(".")==0 || email.indexOf("@")==0) {
		aviso += "E-mail \n";
		if (verificaFocus == false) {
			document.getElementById("email").focus();
			verificaFocus = true;
		}
		document.getElementById("email").value="";
	}

	if (aviso == "") {
		return true;
	} else {
		alert ("Preencha corretamente o(s) dado(s) a seguir: \n"+aviso);
		return false;
	}
}

function exibeMsg(){
	alert("O email inserido deve ser idêntico ao registrado juntamente com o usuário em questão.");

}
