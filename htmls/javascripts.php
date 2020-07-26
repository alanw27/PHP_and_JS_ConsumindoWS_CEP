<script type="text/javascript" src="/TesteCD2/js/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="/TesteCD2/js/jquery-ui/jquery-ui.js"></script>
<script type="text/javascript" src="/TesteCD2/js/bootstrap.min.js"></script>
<script type="text/javascript" src="/TesteCD2/js/twitter-bootstrap-hover-dropdown.min.js"></script>
<script type="text/javascript" src="/TesteCD2/js/bootstrap-admin-theme-change-size.js"></script>
<script type="text/javascript" src="/TesteCD2/js/jquery.maskedinput.js"></script>
<script type="text/javascript" src="/TesteCD2/js/dataTables.min.js"></script>
<script type="text/javascript" src="/TesteCD2/js/jquery.maskMoney.js"></script>
<script type="text/javascript">

$(document).ready(function()
{
	var table = $('#example').dataTable
	({
		"oLanguage":
		{
			"sEmptyTable": "Tabela vazia. Faça uma busca acima.",
			"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
			"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
			"sInfoFiltered": "(Filtrados de _MAX_ registros)",
			"sInfoPostFix": "",
			"sInfoThousands": ".",
			"sLengthMenu": "_MENU_ resultados por página",
			"sLoadingRecords": "Carregando...",
			"sProcessing": "Processando...",
			"sZeroRecords": "Nenhum registro encontrado",
			"sSearch": "Pesquisar",
			"oPaginate": {
				"sNext": "Próximo",
				"sPrevious": "Anterior",
				"sFirst": "Primeiro",
				"sLast": "Último"
			},
			"oAria": {
				"sSortAscending": ": Ordenar colunas de forma ascendente",
				"sSortDescending": ": Ordenar colunas de forma descendente"
			}
		}
	});
	$(".datepicker").datepicker({
	    dateFormat: 'dd/mm/yy',
	    dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
	    dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
	    dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
	    monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
	    monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
	    nextText: 'Próximo',
	    prevText: 'Anterior'
	});
	$(".cpf_cnpj").on('focusin',function(){
	    var target = $(this);
	    var val = target.val();
	    target.unmask();
	    val = val.split(".").join("");
	    val = val.split("-").join("");
	    val = val.split("/").join("");
	    target.val(val);
	});
	$(".cpf_cnpj").on('focusout',function(){
	    var target = $(this);
	    var val = target.val();
	    val = val.split(".").join("");
	    val = val.split("-").join("");
	    val = val.split("/").join("");
	    if (val.length==11) {
	        target.mask("999.999.999-99");
	        target.val(val);
	    } else {
	        if (val.length==14) {
	            target.mask("99.999.999/9999-99");
	            target.val(val);
	        } else {
	            target.val('');
	        }
	    }
	});
	$(".telefone")
        .mask("(99) 9999-9999?9")
        .focusout(function (event) {  
            var target, phone, element;  
            target = (event.currentTarget) ? event.currentTarget : event.srcElement;  
            phone = target.value.replace(/\D/g, '');
            element = $(target);  
            element.unmask();  
            if(phone.length > 10) {  
                element.mask("(99) 99999-999?9");  
            } else {  
                element.mask("(99) 9999-9999?9");  
            }  
    });
});
$(document).on('keypress', 'input.somente-numero', function(e) {
var key = (window.event)?event.keyCode:e.which;
if((key > 47 && key < 58)) 
{
	this.style.backgroundColor = "#ffffff";
	return true;
	} 
	else 
	{
	  	this.style.backgroundColor = "#ff0000";
		return (key == 8 || key == 0)?true:false;
	}
});
var keyStr = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=";

function encode64(input) 
{
    input = escape(input);
    var output = "";
    var chr1, chr2, chr3 = "";
    var enc1, enc2, enc3, enc4 = "";
    var i = 0;

    do {
        chr1 = input.charCodeAt(i++);
        chr2 = input.charCodeAt(i++);
        chr3 = input.charCodeAt(i++);

        enc1 = chr1 >> 2;
        enc2 = ((chr1 & 3) << 4) | (chr2 >> 4);
        enc3 = ((chr2 & 15) << 2) | (chr3 >> 6);
        enc4 = chr3 & 63;

        if (isNaN(chr2)) 
        {
           enc3 = enc4 = 64;
        } 
        else if (isNaN(chr3)) 
        {
           enc4 = 64;
        }

       output = output +
       keyStr.charAt(enc1) +
       keyStr.charAt(enc2) +
       keyStr.charAt(enc3) +
       keyStr.charAt(enc4);

       chr1 = chr2 = chr3 = "";
       enc1 = enc2 = enc3 = enc4 = "";
    } 
    while (i < input.length);

    return output;
}
function decode64(input) 
{
	var output = "";
	var chr1, chr2, chr3 = "";
	var enc1, enc2, enc3, enc4 = "";
	var i = 0;

	// remove all characters that are not A-Z, a-z, 0-9, +, /, or =
	var base64test = /[^A-Za-z0-9\+\/\=]/g;

	if (base64test.exec(input)) 
	{
		alert("There were invalid base64 characters in the input text.\n" +
      	"Valid base64 characters are A-Z, a-z, 0-9, '+', '/',and '='\n" +
      	"Expect errors in decoding.");
	}

	input = input.replace(/[^A-Za-z0-9\+\/\=]/g, "");

	do {

		enc1 = keyStr.indexOf(input.charAt(i++));
		enc2 = keyStr.indexOf(input.charAt(i++));
		enc3 = keyStr.indexOf(input.charAt(i++));
		enc4 = keyStr.indexOf(input.charAt(i++));

		chr1 = (enc1 << 2) | (enc2 >> 4);
		chr2 = ((enc2 & 15) << 4) | (enc3 >> 2);
		chr3 = ((enc3 & 3) << 6) | enc4;

		output = output + String.fromCharCode(chr1);

		if (enc3 != 64) 
		{
   			output = output + String.fromCharCode(chr2);
		}

		if (enc4 != 64) 
		{
		   output = output + String.fromCharCode(chr3);
		}

		chr1 = chr2 = chr3 = "";
		enc1 = enc2 = enc3 = enc4 = "";

	} 
	while (i < input.length);

	return unescape(output);
}
function queryString(parameter)
{
	var loc = location.search.substring(1, location.search.length);   
	var param_value = false;   
	var params = loc.split("&");   
	for (i=0; i<params.length;i++) {   
	  param_name = params[i].substring(0,params[i].indexOf('='));   
	  if (param_name == parameter) {                                          
	      param_value = params[i].substring(params[i].indexOf('=')+1)   
	  }   
	}   
	if (param_value) {   
	  return param_value;   
	}   
	else {   
	  return false;   
	}   
}
function validaCpf(id_campo) 
{
	var strCPF = $('#' + id_campo).val().replace(/[^\d]+/g,'');
    var Soma;
    var Resto;
    Soma = 0;
	if (strCPF == "00000000000") 
	{
		alert("Por favor digite um cpf válido!");
		return false;
	}
	for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
	Resto = (Soma * 10) % 11;
	
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(9, 10)) )	
    {
		alert("Por favor digite um cpf válido!");
		return false;
	}
	
	Soma = 0;
    for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
    Resto = (Soma * 10) % 11;
	
    if ((Resto == 10) || (Resto == 11))  Resto = 0;
    if (Resto != parseInt(strCPF.substring(10, 11) ) )	
    {
		alert("Por favor digite um cpf válido!");
		return false;
	}
    return true;
}
function modalMessage(title, mensage)
{
	$('#dialog-message').prop('title', title);
	$( "#dialog-message" ).dialog({
		modal: true,
		buttons: {
			Ok: function() {
				$("#dialog-message").dialog('close');
			}
		}
	});
	$("#message_modal").html(mensage);
}
function calcularIdade(aniversario) 
{
    var nascimento = aniversario.split("/");
    var dataNascimento = new Date(parseInt(nascimento[2], 10),
    parseInt(nascimento[1], 10) - 1,
    parseInt(nascimento[0], 10));

    var diferenca = Date.now() -  dataNascimento.getTime();
    var idade = new Date(diferenca);

    return Math.abs(idade.getUTCFullYear() - 1970);
}
function somenteNumeros(num) 
{
    var er = /[^0-9.]/;
    er.lastIndex = 0;
    var campo = num;
    if (er.test(campo.value)) {
      campo.value = "";
    }
}
function validaEmail(id_campo)
{
	var testEmail = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
	if (!testEmail.test($('#' + id_campo).val()))
	{
		alert("Por favor digite um E-MAIL válido");
		return false;
	}
	else
	{
		return true;
	}
}
function validaCampo(id_campo)
{
	if( $.trim($('#' + id_campo).val()) == "" )
	{
		$('#' + id_campo).css('border', 'solid 3px red');
		$('#' + id_campo).focus();
		return false;
	}
	else
	{
		$('#' + id_campo).css('border', 'solid 1px green');
		return true;
	}
}
function dataAtual()
{
    var data = new Date();
    var dia = data.getDate();
    if (dia.toString().length == 1)
      dia = "0"+dia;
    var mes = data.getMonth()+1;
    if (mes.toString().length == 1)
      mes = "0"+mes;
    var ano = data.getFullYear();  
    return dia+"/"+mes+"/"+ano;
}
function escapeRegExp(str) 
{
    return str.replace(/([.*+?^=!:${}()|\[\]\/\\])/g, "\\$1");
}
function replaceAll(str, find, replace) 
{
  return str.replace(new RegExp(escapeRegExp(find), 'g'), replace);
}
function currencyFormat (num) 
{
    return num.toFixed(2).replace(",", ".").replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,")
}
function isObject(val) 
{
    return (typeof val === 'object');
}
</script>
