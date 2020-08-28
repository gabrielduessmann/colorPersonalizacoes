function validarCampos(){

	var cliente = document.getElementById("cliente").value;
	// alert (cliente);
	var parcelas = document.getElementById("parcelas").value;
	// alert (parcelas);
	var desconto = document.getElementById("desconto").value;
	// alert (desconto);
	var entrega = $("input[name='pontoDeEntrega']:checked").val();
	//alert (entrega);
	var cep = document.getElementById("cep").value;
	// alert (cep);
	var estado = document.getElementById("estado").value;
	// alert (estado);
	var cidade = document.getElementById("cidade").value;
	// alert (cidade);
	var bairro = document.getElementById("bairro").value;
	// alert (bairro);
	var rua = document.getElementById("rua").value;
	// alert (rua);
	var numero = document.getElementById("numero").value;	
	// alert(numero);

	// alert (linhas.length - 1);
	
	/*var categoria = document.getElementById("categoria").value;
	var produto = document.getElementById("produto").value; 
	var quantidade = document.getElementById("quantidade").value;
	var descricao = document.getElementById("descricao").value;*/
	
	var aviso = "";
	var verificaFocus = false;
	if(cliente == 0){
		aviso += "Cliente \n";
		if (verificaFocus == false) {
			document.getElementById("cliente").focus();
			verificaFocus = true;	
		}
	}
	if (entrega==2) {

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
	}

	var tabela = document.getElementById("tabelaProdutos");
	var linhas = tabela.getElementsByTagName("tr");
	linhas = linhas.length;
	linhas = linhas - 1;
	// alert (linhas);

	var produto;
	for (var i=0; i<linhas;i++) {
		produto = document.getElementById("produtos"+i).value;
		if (produto=="0") {
			aviso += "Produto (linha "+(i+1)+") \n";
			if (verificaFocus == false) {
				document.getElementById("produtos"+i).focus();
				verificaFocus = true;
			}
		}		
	}

	if (aviso == "") {
		alert ("Orçamento registrado.");
		return true;
	} else {
		alert ("Preencha corretamente o(s) dado(s) a seguir: \n"+aviso);
		return false;
	}
}



function validarConsulta(){
	
	var nome = document.getElementById("campoNomeCliente").value;
	var aviso = "";
	var verificaFocusConsulta = false;
	
	var nomeSplit = nome.split(" ");
	if (nomeSplit.length == 1) {
		aviso += "Nome informado incorretamente";
		document.getElementById("campoNomeCliente").focus();
		verificaFocusConsulta = true;
		document.getElementById("campoNomeCliente").value="";
	}
	
	if (aviso == "") {
		return true;
	} else {
		alert ("Orçamento não encontrado.");
		return false;
	}
	
}

function mostraLocalizacao(){
	document.getElementById("pontoDeEntrega").style.display = 'block';
}

function ocultaLocalizacao(){
	document.getElementById("pontoDeEntrega").style.display='none';
	document.getElementById("pontoDeEntrega").reset();
}

function retornaProdutos(cont) {
	var campo = "#categorias"+cont;
	var codigoCategoria = document.getElementById("categorias"+cont).value;
	var pagina = "retornaProdutos.php";
	

		$.ajax({
			type: 'POST',
			dataType: 'html',
			url: pagina,
			data: {id:codigoCategoria},
			success: function(produtos){
				var inputCategorias = ("#produtos"+cont);
				$(inputCategorias).empty();
				$(inputCategorias).append(produtos);	
			}
		});
	
	$("#vlUnitario"+cont).val("0.00");
}


function retornaValorUnitario(cont) {
	var idProduto = document.getElementById("produtos"+cont).value;
	var pagina = "retornaValorUnitario.php";
	$.ajax({
		type: 'POST',
		dataType: 'html',
		url: pagina,
		data: {id:idProduto},
		success: function(valorUnitario){
			var inputValoUnitario = ("#vlUnitario"+cont);
			$(inputValoUnitario).val(valorUnitario);
			atualizaValorTotal(cont);
		}
	});
}

var valoresJaAdicionadosAoTotal = [];

function atualizaValorTotal(cont) {
	var produtoSelecionado = $("#produtos"+cont).val()
	var valorJaAdicionado = valoresJaAdicionadosAoTotal[cont];
	var valorTotalAtual = document.getElementById("valorTotal").value;
	var valorUnitarioProduto = document.getElementById("vlUnitario"+cont).value;
	var qtde = document.getElementById("qtde"+cont).value;
	var desconto = document.getElementById("desconto").value;
	// alert (desconto);

	/*alert(" Produto selecionado: "+produtoSelecionado+"\n Valor Ja adicionado: "+valorJaAdicionado+
	"\n Valor total atual: "+valorTotalAtual+"\n Valor Unitario: "+valorUnitarioProduto+"\n Quantidade: "+qtde);*/
	
	valorTotalAtual = parseFloat(valorTotalAtual);
	valorUnitarioProduto = parseFloat(valorUnitarioProduto);

	if (desconto!=0 || desconto!="") {
		descontoValorTotal();
	} else {
	
	if ((produtoSelecionado!=0) && (valorJaAdicionado==null)) {
		var valorAtualizado = (valorUnitarioProduto*qtde)+valorTotalAtual;
		// alert (valorAtualizado);
		$("#valorTotal").val(valorAtualizado);
	} else if ((produtoSelecionado!=0) && (valorJaAdicionado!=null)) {
		var valorAtualizado = (valorTotalAtual-valorJaAdicionado)+valorUnitarioProduto*qtde;
		$("#valorTotal").val(valorAtualizado);	
	}
	}
	parcelaValor();
	valoresJaAdicionadosAoTotal[cont]=valorUnitarioProduto*qtde;
}

function descontoValorTotal() {	
	var desconto = document.getElementById("desconto").value;
	if (desconto=="") {
		desconto = 0;
	}
	var valorTotal = document.getElementById("valorTotal").value;
	var vlUnitario=0;
	var qtde=0;
	var valorTotalAtual=0;


		for (var i=0; i<100; i++) {
			if (document.getElementById("vlUnitario"+i)!=null) {
				vlUnitario = document.getElementById("vlUnitario"+i).value;
				qtde = document.getElementById("qtde"+i).value;
				valorTotalAtual = valorTotalAtual + (vlUnitario*qtde);
			}
		}
		// alert (valorTotalAtual);
		if (desconto != 0 || desconto != "") {
			valorTotalAtual = valorTotalAtual * (1-desconto/100);
		}
		$("#valorTotal").val(valorTotalAtual);
		parcelaValor();

}

function parcelaValor() {
	var numParcelas = $("#parcelas").val();
	var valorTotal = document.getElementById("valorTotal").value;

	if (numParcelas=="" || numParcelas=="2x" || numParcelas=="3x" || numParcelas=="4x" || numParcelas=="5x" || 
	numParcelas=="6x" || numParcelas=="7x" || numParcelas=="8x" || numParcelas=="9x" || numParcelas=="10x" ||
	numParcelas=="11x" || numParcelas=="12x" || numParcelas=="0" || numParcelas=="1" || numParcelas=="2" || numParcelas=="3" 
	|| numParcelas=="4" || numParcelas=="5" || numParcelas=="6" || numParcelas=="7" || numParcelas=="8" || numParcelas=="9" || 
	numParcelas=="10" ||numParcelas=="11" || numParcelas=="12") {
	if (numParcelas != "" && numParcelas != "0" && numParcelas != "1") {

		document.getElementById("labelCadaParcela").style.display = 'inline';	
		document.getElementById("valorCadaParcela").style.display = 'inline';
		
		numParcelas = parseInt(numParcelas.replace(/[^0-9]/g,'')); // tira o caracterer, so deixa o número como inteiro

		valorTotal = document.getElementById("valorTotal").value;

		$("#valorCadaParcela").val(valorTotal/numParcelas);

	} else {
		document.getElementById("parcelas").value="";
		document.getElementById("labelCadaParcela").style.display = 'none';
		document.getElementById("valorCadaParcela").style.display = 'none';
		$("#valorTotal").val(valorTotal);
	}

	}else {
		alert ("Número de parcelas incorreto");
		document.getElementById("parcelas").value="";
		document.getElementById("parcelas").focus;
		document.getElementById("labelCadaParcela").style.display = 'none';
		document.getElementById("valorCadaParcela").style.display = 'none';
		$("#valorTotal").val(valorTotal);
	}
}
var cont = 1;


function adicionaProduto() {
	var categorias = $("#todasAsCategorias").val();	
	var produtos = $("#todosOsProdutos").val();
	$("#tabelaProdutos").append(
	
	'<tr id="linha'+cont+'">'+
		'<td>'+
			'<select name="categorias" id="categorias'+cont+'" class="categorias"'+
			'onchange="retornaProdutos('+cont+')">'+
				categorias+
			'</select>'+
		'</td>'+

		'<td>'+
			'<select name="produtos[]" id="produtos'+cont+'" class="produtos"'+
			'onchange="retornaValorUnitario('+cont+')">'+
				produtos+
			'</select>'+
		'</td>'+
		
		'<td>'+
				'<input type="text" required  value="0.00 " class="vlUnitario"'+
				'id="vlUnitario'+cont+'" name="valoresUnitarios[]" readonly="readonly">'+
		'</td>'+

		'<td>'+
			'<input required type="number" name="qtdeProdutos[]" class="qtde"'+
				'onblur="atualizaValorTotal('+cont+')" id="qtde'+cont+'" min="1" value="0">'+
		'</td>'+

		'<td>'+
			'<input type="text" class="desc" id="desc'+cont+'" name="descs[]">'+
		'</td>'+

		'<td>'+
			'<button type="button" class="botaoMais" onclick="adicionaProduto()">'+
				'<img src="../../img/botaoMais.png" alt="botão para adicionar mais um produto" class="imgMais">'+
			'</button>'+
			'<button type="button" class="botaoMenos" onclick="removeProduto('+cont+')">'+
			'<img src="../../img/botaoMenos.png" alt="botão para remover um produto" class="imgMenos">'+
			'</button>'+			
		'</td>'+
	'</tr>'
	);
	cont++;
}

function removeProduto(cont) {
	var valorTotalAtualPedido = $("#valorTotal").val();
	var produtoSelecionado = $("#produtos"+cont).val();

	if ((valorTotalAtualPedido != 0.00) && (produtoSelecionado!=0)) {
		var valorUnitario = $("#vlUnitario"+cont).val();
		var qtde = $("#qtde"+cont).val();
		var valorReduzir = parseFloat(valorUnitario) * parseInt(qtde);
		$("#valorTotal").val(valorTotalAtualPedido-valorReduzir);
	}
	$("#linha"+cont).remove();
}

