$(document).ready(function() {
    $('.btn-new-relatorio').click(function() {
        $('.container-fluid').empty()
        $('.container-fluid').load('form-relatorio.html')
    })

    $('.btn-send').click(function(e) {

        e.preventDefault()

        var dados = $('#form-relatorio').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/new-relatorio.php',
            async: true,
            data: dados,
            success: function(dados) {
                Swal.fire({
                    icon: dados.icone,
                    html: '<h2 style="color:white;">' + dados.msg + '</h2>',
                    background: 'rgb(39, 39, 61)',
                })
                if (dados.icone == 'success') {
                    $('.input').val('')
                }
            }
        });
    })
})