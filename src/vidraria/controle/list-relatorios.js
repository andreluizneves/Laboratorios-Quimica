$(document).ready(function() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        assync: true,
        url: '../modelo/list-relatorio.php',
        success: function(retorno) {
            if (retorno.status == 'ok') {
                for (const dado of retorno.dados) {
                    $('#seletor-relatorio').append(`<option value="${dado.id_relatorio}">${dado.titulo}</option>`)
                }
            }

        }
    })
})