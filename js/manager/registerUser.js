function validarCampos(verifica){



	var nome = document.getElementById("nomecompleto").value;
	var email = document.getElementById("email").value;
	var rua = document.getElementById("rua").value;
	var cidade = document.getElementById("cidade").value;
	var cpf = document.getElementById("cpf").value.replace(/\D/g, '');
	var cep = document.getElementById("cep").value.replace(/\D/g, '');
	var bairro = document.getElementById("bairro").value;
	var estado = document.getElementById("estado").value;
	var senha = document.getElementById("senha").value;
	var usuario = document.getElementById("usuario").value;
	var permissao = document.getElementById("permissao").value;
	var aviso = "";
	var verificaFocus = false;


	var nomeSplit = nome.split(" ");
	if (nomeSplit.length == 1) {
		aviso += "Nome completo \n";
		if (verificaFocus == false) {
		document.getElementById("nomecompleto").focus();
		verificaFocus = true;
		document.getElementById("nomecompleto").value="";
		}
	}




if (email == "" || email.indexOf("@") == -1 || email.indexOf(".") == -1 || email.indexOf(".")==0 || email.indexOf("@")==0) {
		aviso += "E-mail \n";
		if (verificaFocus == false) {
			document.getElementById("email").focus();
			verificaFocus = true;
		}
		document.getElementById("email").value="";
	}


	if (cpf.length != 11) {
		aviso += "CPF \n";
		if (verificaFocus == false) {
			document.getElementById("cpf").focus();
			verificaFocus = true;
		}
		document.getElementById("cpf").value="";
	}



	if (rua == "") {
		aviso += "Rua \n";
		if (verificaFocus == false) {
			document.getElementById("rua").focus();
			verificaFocus = true;
		}
		document.getElementById("rua").value="";
	}




	if (cidade == "") {
		aviso += "Cidade \n";
		if (verificaFocus == false) {
		document.getElementById("cidade").focus();
		verificaFocus = true;
		}
		document.getElementById("cidade").value="";
	}

	if (verifica == "sim") {

		if (senha.length<8) {
		aviso += "Senha \n";
		if (verificaFocus == false){
			document.getElementById("senha").focus();
			verificaFocus = true;
		}
		document.getElementById("senha").value="";
	}

	}


		if (usuario == "") {
		aviso += "Usuário \n";
		if (verificaFocus == false) {
		document.getElementById("usuario").focus();
		verificaFocus = true;
		}
		document.getElementById("usuario").value="";
	}


	if (cep.length != 8) {
		aviso += "CEP \n";
		if (verificaFocus == false) {
			document.getElementById("cep").focus();
			verificaFocus = true;
		}
		document.getElementById("cep").value="";
	}







	if (bairro == "") {
		aviso += "Bairro \n";
		if (verificaFocus == false)
		document.getElementById("bairro").focus();
		verificaFocus = true;
		document.getElementById("bairro").value="";
	}

	if (estado != "AC" && estado != "AL" && estado != "AP" && estado != "AM" && estado != "BA" && estado != "CE" && estado != "DF" && estado != "ES" && estado != "GO"
	&& estado != "MA" && estado != "MT" && estado != "MS" && estado != "MG" && estado != "PA" && estado != "PB" && estado != "PR" && estado != "PE" && estado != "PI"
	&& estado != "RR" && estado != "RO" && estado != "RJ" && estado != "RN" && estado != "RS" && estado != "SC" && estado != "SP" && estado != "SE" && estado != "TO") {
		aviso += "Estado \n";
		if (verificaFocus == false)
		document.getElementById("estado").focus();
		verificaFocus = true;
		document.getElementById("estado").value="";
	}

	if (permissao != "1" && permissao != "2" && permissao!="3") {

		aviso += "Grau de permissão \n";
		if (verificaFocus == false) {
			document.getElementById("permissao").focus();
			verificaFocus = true;
		}
		document.getElementById("permissao").value="";
	}




	if (aviso != "") {
		alert ("Preencha corretamente o(s) dado(s) a seguir: \n"+aviso);
		return false;
	}


}

function validarConsulta(){

	var consultaUsuario = document.getElementById("consultaUsuario").value;
	var aviso = "";
	var verificaFocus = false;


		var consultaUsuarioSplit = consultaUsuario.split(" ");
	if (consultaUsuarioSplit.length == 1) {
		aviso += "Usuário não encontrado.\n";
		document.getElementById("consultaUsuario").focus();
		verificaFocus = true;
		document.getElementById("consultaUsuario").value="";
	}




	if (aviso == "") {
		return true;
	} else {
		alert (""+aviso);
		return false;
	}

}

function validaUsuario(editar, id){
		var id = id;
		var usuario = document.getElementById('usuario').value;
		var pagina = "";
		if (editar=="editar") {
			var pagina = "validaUsuario1.php";
		}else {
			var pagina = "validaUsuario.php";
		}
		$.ajax({
			type: 'POST',
			dataType: 'html',
			url: pagina,
			data: {usuario:usuario, id:id},
			success: function(testadora){
				if (testadora==1) {
					alert("O usuário já existe!");
					document.getElementById('usuario').value="";
				}else if(testadora == 0){
					document.getElementById('usuario').value=usuario;
				}
			}
		});

}
