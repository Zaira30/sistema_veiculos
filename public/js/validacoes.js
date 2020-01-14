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
//validacao telefone
var SPMaskBehavior = function (val) {
        return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    },
    spOptions = {
        onKeyPress: function(val, e, field, options) {
            field.mask(SPMaskBehavior.apply({}, arguments), options);
        }
    };
$('.telefone2').mask(SPMaskBehavior, spOptions);

$('.telefone2').change(function () {
    $( ".telefone2" ).each(function() {
        if($(this).val().replace(/\D/g, '').length < 10) {
            $(this).closest('.form-group').addClass('has-error has-danger');
            $(this).closest('.form-group').find('.help-block').html("");
            $(this).val("");

        }

        if($(this).val().replace(/\D/g, '').length >= 10) {
            $(this).closest('.form-group').find('.help-block').html("");
        }
        return false;
    });
});
