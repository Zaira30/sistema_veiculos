

$(function() {
    $('#htmlTag').addClass('mm-wrapper_sidebar-collapsed-40 mm-wrapper_sidebar-expanded-30 mm-wrapper_sidebar-closed');
    $('#menu').removeClass('mm-menu_opened');
    $('#menu').removeAttr('aria-hidden');
});
//  Função para validar CNPJ
 function valida_cnpj(val) 
         {
          if (val.match(/^\d{2}\.\d{3}\.\d{3}\/\d{4}\-\d{2}$/) != null) {
            var val1 = val.substring(0, 2);
            var val2 = val.substring(3, 6);
            var val3 = val.substring(7, 10);
            var val4 = val.substring(11, 15);
            var val5 = val.substring(16, 18);

            var i;
            var number;
            var result = true;

            number = (val1 + val2 + val3 + val4 + val5);

            s = number;

            c = s.substr(0, 12);
            var dv = s.substr(12, 2);
            var d1 = 0;

            for (i = 0; i < 12; i++)
              d1 += c.charAt(11 - i) * (2 + (i % 8));

            if (d1 == 0)
              result = false;

            d1 = 11 - (d1 % 11);

            if (d1 > 9) d1 = 0;

            if (dv.charAt(0) != d1)
              result = false;

            d1 *= 2;
            for (i = 0; i < 12; i++) {
              d1 += c.charAt(11 - i) * (2 + ((i + 1) % 8));
            }

            d1 = 11 - (d1 % 11);
            if (d1 > 9) d1 = 0;

            if (dv.charAt(1) != d1)
              result = false;

            return result;
          }
          return false;
         }

/**** Modal confirmar Deletar ***/
function alertModal (string,form){
	var form = $(form).parents('form:first');
	$.confirm({
		theme: 'light',
	    title: 'ALERTA',
	    content: string,	    
	    buttons: {
	        confirm:{
	        	text: 'Excluir',
	        	btnClass: 'btn-danger',
		        action: function(){
	                $(form).submit();
	            }
	        },
	        cancel:{
	        	text: 'Cancelar',	        	
	        }	                
	    }
	});
}


/**** Modal alert ***/
function alert (textoAlert){
    $.confirm({
        theme: 'light',
        title: 'ALERTA',
        content: textoAlert,
        buttons: {
            confirm:{
                text: 'OK',
                btnClass: 'btn-info',
                action: function(){

                }
            }
        }
    });
}
/****** Validação CPF VALIDO *******/
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

/****** Validação CPF VALIDO *******/
function validaCPF(strCPF) {
  var Soma;
  var Resto;
  Soma = 0;
  if (strCPF == "00000000000" || strCPF == "11111111111" || strCPF == "22222222222" || strCPF == "33333333333" || strCPF == "44444444444" || strCPF == "55555555555" || strCPF == "66666666666" || strCPF == "77777777777" || strCPF == "88888888888" || strCPF == "99999999999") return false;
    
  for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;
  
  if ((Resto == 10) || (Resto == 11))  Resto = 0;
  if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;

  Soma = 0;
  for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
  Resto = (Soma * 10) % 11;

  if ((Resto == 10) || (Resto == 11))  Resto = 0;
  if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;

  return true;
}

$(".cpfvalido").blur(function() {  
  	var cpfLimpo = $(this).val().replace(/[\.-]/g, "");  

    if(validaCPF(cpfLimpo) == false){    
      $('.box_cpfvalido').addClass('has-error has-danger'); 
      $('.erro_cpf').html('CPF Inválido');

    }else{
      $('.box_cpfvalido').removeClass('has-error has-danger');
      $('.erro_cpf').html('');
    } 
});

$(".cpfvalido").keyup(function() {
    $('.box_cpfvalido').removeClass('has-error has-danger');
    $('.erro_cpf').html('');
});

$('.form').validator().on('submit', function (e) {	
  	if($('.cpfvalido').length){   		  		
	    var cpfLimpo = $( ".cpfvalido" ).val().replace(/[\.-]/g, "");

	    if(validaCPF(cpfLimpo) == false){
	      $('.box_cpfvalido').addClass('has-error has-danger'); 
	      $('.erro_cpf').html('CPF Inválido');       
	      return false;      
	    }       
  	}  
});
/****** Validação CPF VALIDO *******/



var iconsMenu = [];

/****** EXECUTA MENU SIDEBAR *******/
$( document ).ready(function() {

    $('.principal').click(function(e) {
     //   console.log($(this).attr('value'));
    });

    iconsMenu.push('<a href="/home"><i class="fa fa-home"></i></a>');


    $('.navbarIconsMenu li').each(function(){
        iconsMenu.push($(this).html());
    });


   // $('#menuPrincipal li a').attr('href');

       ///deletado erro de js que estava aqui


    $('#htmlTag').attr('class','');
    $('#htmlTag').addClass('mm-wrapper_sidebar-collapsed-40 mm-wrapper_sidebar-closed');
    $('#menu').attr('aria-hidden',true);
    $('.mm-menu__blocker').removeClass('mm-menu__blocker');

    $('#abrirMenu').click(function() {
        $('.mm-iconbar').trigger('click');

    });

    $('.mm-iconbar a').click(function(e) {
        $('.IconeClicado').removeClass('IconeClicado');

        if($(e.target).hasClass('fa'))
            $(e.target).parent().addClass("IconeClicado");
        else
            $(e.target).addClass("IconeClicado");


        $('#htmlTag').attr('class','');
        $('#htmlTag').addClass('mm-wrapper_opened mm-wrapper_blocking mm-wrapper_background mm-wrapper_opening');
        $('#menu').addClass('mm-menu_opened');
        $('#menu').attr('aria-hidden',true);



    });

    var i=2;
    $('#menuPrincipal li a').each(function(){
         $('.mm-iconbar a:nth-child('+i+')').attr('href',$(this).attr('href'));
        i++;
    });


    var menuGeral = document.querySelector("#menu");
    $('.mm-searchfield__input input').attr('placeholder','Pesquisar')

    $(document).on("click", function(e) {

        if (!menuGeral.contains(e.target) && e.target.id!='abrirMenu')
        {
            $('#htmlTag').attr('class','');
            $('#htmlTag').addClass('mm-wrapper_sidebar-collapsed-40 mm-wrapper_sidebar-closed');
            $('#menu').removeAttr('aria-hidden');

            $('.IconeClicado').removeClass('IconeClicado');

        }
        setTimeout(function(){ $('.mm-panel').removeClass('mm-panel_opened-parent'); }, 100);

    });

    jQuery(function ($) {
        $.datepicker.regional['pt'] = {
            closeText: 'Fechar',
            currentText: 'Hoje',
            monthNames: ['Janeiro', 'Fevereiro', 'Mar&ccedil;o', 'Abril', 'Maio', 'Junho',
                'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
            monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun',
                'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
            dayNames: ['Domingo', 'Segunda-feira', 'Ter&ccedil;a-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'S&aacute;bado'],
            dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b'],
            dayNamesMin: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'S&aacute;b'],
            weekHeader: 'Sem',
            dateFormat: 'dd/mm/yy',
            firstDay: 0,
            isRTL: false,
            showMonthAfterYear: false,
            yearSuffix: '',
            nextText: 'Próximo', prevText: 'Anterior'
        };
        $.datepicker.setDefaults($.datepicker.regional['pt']);
    });



    $('.datepicker').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR',
        //,changeMonth: true
        //,changeYear: true
        nextText: 'Próximo', prevText: 'Anterior'
    });
    $('.datepickerMesAnoCombo').datepicker({
        format: 'dd/mm/yyyy',
        language: 'pt-BR'
        ,changeMonth: true
        ,changeYear: true
    });


});




$( document ).ready(function() {


    

        $(".datepicker").datepicker({
            dateFormat: "dd/mm/yy",
            language: 'pt-BR',
            onSelect: function (date) {
                var dt2 = $('.datepicker');
                var startDate = $(this).datepicker('getDate');
                var minDate = $(this).datepicker('getDate');
                dt2.datepicker('setDate', minDate);
                startDate.setDate(startDate.getDate() + 30);
                //sets dt2 maxDate to the last day of 30 days window
                //dt2.datepicker('option', 'maxDate', startDate);
                dt2.datepicker('option', 'minDate', minDate);
                //$(this).datepicker('option', 'minDate', minDate);
            }
        });

        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            language: 'pt-BR'
        });

    $(".dataMascara").mask("99/99/9999");
    $(".cep").mask("00000-000");
    $(".telefone").mask("(99) 9999-9999");
    $(".celular").mask("(99) 99999-9999");
    $(".cpf").mask("999.999.999-99");
    $(".cnpj").mask("99.999.999/9999-99");
});
