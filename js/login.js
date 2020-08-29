function validarCampos() {

	var usuario = document.getElementById("usuario").value;
	var senha = document.getElementById("senha").value;
	var aviso = "";
	var verificaFocus = false;

	if (usuario == "") {
		aviso += "Usuário \n"
		document.getElementById("usuario").focus();
		verificaFocus = true;

	}

if (senha == "" || senha.length<8) {
		aviso += "Senha \n";
		if (verificaFocus == false) {
			document.getElementById("senha").focus();
		}
		document.getElementById("senha").value="";
	}

	if (aviso == "") {
		return true;
	} else {
		alert("Preencha corretamete: \n"+aviso)
		return false;
	}

}

function validaUsuario(){
		var usuario = document.getElementById('usuario').value;
		var pagina = "validaUsuario.php";
		$.ajax({
			type: 'POST',
			dataType: 'html',
			url: pagina,
			data: {usuario:usuario},
			success: function(testadora){
				if (testadora==1) {
					document.getElementById('usuario').value=usuario;
				}else if(testadora == 0){
					alert("O usuário não existe no sistema!");
					document.getElementById('usuario').value="";
				}
			}
		});



}

function botaoEsqueci(){
	var usuario = document.getElementById('usuario').value;
	if (usuario=="") {
		alert("É necessário inserir um usuário cadastrado para dar acesso à essa página.");
		document.getElementById('linkEsqueciSenha').href="#";
	}else {
		document.getElementById('linkEsqueciSenha').href="esqueciminhasenha.php";
	}
}
