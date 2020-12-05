$(document).ready(function() {

    $.ajax({
        dataType: 'json',
        url: '../modelo/seguranca.php',
        success: function(dados) {
            if (dados.logado == 'sim') {
                $(location).attr('href', '/menu.html')
            }
        }
    });

    $('.seletor').on('change', function() {
        if ($('#rm').css('display') == 'none') {
            $('.img').attr('src', 'recursos/img/icons/alunos.svg')
            $('#rm').show(490)
            $('#ra').hide()
            $('#ra').prop('disabled', true)
            $('#rm').prop('disabled', false)
            $('#ra').val('')
        } else {
            $('.img').attr('src', 'recursos/img/icons/professores.svg')
            $('#rm').hide()
            $('#ra').show(490)
            $('#ra').prop('disabled', false)
            $('#rm').prop('disabled', true)
            $('#rm').val('')
        }
    })

    $('.btn-cadastro').click(function(e) {

        e.preventDefault()

        var dados = $('#form-cadastro').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'src/usuario/modelo/cadastro.php',
            async: true,
            data: dados,
            success: function(dados) {
                Swal.fire({
                    icon: dados.icone,
                    html: '<h2 style="color:white;">' + dados.mensagem + '</h2>',
                    background: 'rgb(39, 39, 61)',
                })
                if (dados.icone == 'success') {
                    $('.input').val('')
                }
            }
        });
    })
})