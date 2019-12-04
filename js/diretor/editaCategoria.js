function validarCampos(){



	var descricao = document.getElementById("descricao").value;
	var categoria = document.getElementById("categoria").value;
	var aviso="";
	var verificaFocus = false;

	if(categoria == ""){
		aviso+= "Categoria \n";
		if (verificaFocus == false) {
			document.getElementById("categoria").focus();
			verificaFocus = true;
		}
		document.getElementById("categoria").value="";
	}

	if(aviso == ""){
		alert("Categoria Editada.");
		return true;
	}else {
		alert ("Preencha corretamente o(s) dado(s) a seguir: \n"+aviso);
		return false;
	}



}

function validarConsulta(){

	var categoria = document.getElementById("categoria2").value;
	var aviso = "";

	if(categoria<=1 || categoria>17){
		aviso += "O campo obrigatório 'categoria'.";
	}

	if(aviso==""){
		return true;
	}else if(aviso!=""){
		alert("Categoria não encontrada. ");
		return false;
	}


}
