$('document').ready(function()
{
	$("#btn_salvar").click(function(){
		btn_salvar("salvar_e_concluir");
	});

	$("#btn_cancelar").click(function(){
		location.href = "../index.php";
	});

	$("#cep").blur(function(){
		if($.trim(this.value) != "")
		{
			buscaCEPNaBase(this.value);
		}
	});

	$("#cep").keyup(function(){
		somenteNumeros(this);
	});
});
function buscaCEPNaBase(cep)
{
	var url = "./actions/cadastrar.php";
	var data = 
	{
		acao: "buscaCEPNaBase",
		cep: cep
	};
	
	$.ajax
	({
		cache: false,
		type: "post",
		dataType: "json",
		data: data,
		url: url,
		beforeSend: function()
		{
		},
		success: function(data)
		{
			if(data.length > 0)
			{
				$("#btn_salvar").hide();
				$("#logradouro").val(data[0].logradouro);
				$("#bairro").val(data[0].bairro);
				$("#cidade").val(data[0].cidade);
				$("#uf").val(data[0].uf);	
			}
			else
			{
				$("#btn_salvar").show();
				buscaEndereco(cep);
			}
		},
		error:function()
		{
			modalMessage('Ocorreu um erro ao tentar cadastrar o CEP, se o erro persistir, favor contatar o administrador do sistema!');
		}
	});	
}
function buscaEndereco(cep)
{
	$.ajax({
	  	url  : "//viacep.com.br/ws/"+ cep +"/xml",
	  	type : "get",
	  	dataType: "xml",
	})
	.done(function(xml, statusText, xhr){
	  
	  	var status = xhr.status; 
	 
	  	if(status == 200)
	  	{
	  		var logradouro = $(xml).find("xmlcep").parent().find("logradouro").text();
	  		if(logradouro == "" || logradouro == null || typeof logradouro === "undefined")
	  		{
	  			limparCampos();
	  			modalMessage("AVISO", "CEP não encontrado, por favor verifique se o número digitado está correto!");
			}
			else
			{
				$("#logradouro").val(logradouro);
				$("#bairro").val($(xml).find("xmlcep").parent().find("bairro").text());
				$("#cidade").val($(xml).find("xmlcep").parent().find("localidade").text());
				$("#uf").val($(xml).find("xmlcep").parent().find("uf").text());
			}
	  	}           
	})
	.fail(function(error){
		limparCampos();
		modalMessage("FALHA", "OPS! Desculpe! Houve uma falha ao tentar consultar o CEP. <br><br> Por favor, verifique o número e tente novamente!");
	});
}
function btn_salvar(acao)
{
	if(validaCampo("cep") && validaCampo("logradouro") && validaCampo("bairro") && validaCampo("cidade") && validaCampo("uf"))
	{
		enviarForm(acao);
	}	
	else
	{
		modalMessage("ATENÇÃO", "Campo Obrigatório!");
	}
}
function enviarForm(acao)
{
	var url = "./actions/cadastrar.php";
	var data = 
	{
		acao: acao,
		logradouro: $("#logradouro").val(),
		bairro: $("#bairro").val(),
		cidade: $("#cidade").val(),
		uf: $("#uf").val(),
		cep: $("#cep").val()
	};
	
	$.ajax
	({
		cache: false,
		type: "post",
		dataType: "text",
		data: data,
		url: url,
		beforeSend: function()
		{
		},
		success: function(data)
		{
			modalMessage('AVISO', data);
			limparCampos();
		},
		error:function()
		{
			modalMessage('ERRO','Ocorreu um erro ao tentar cadastrar o CEP, se o erro persistir, favor contatar o administrador do sistema!');
		}
	});	
}
function limparCampos()
{	
	$("#logradouro").val("");
	$("#bairro").val("");
	$("#cidade").val("");
	$("#uf").val("");
	$("#cep").val("");
}