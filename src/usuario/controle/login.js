$(document).ready(function() {

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

    $('.btn-esqueceu-senha').click(function() {
        $(location).attr('href', 'recuperar-senha.php')
    })
    $('#rm, #ra').mask('00000')
    $('.btn-cadastro').click(function() {
        $(location).attr('href', 'cadastrar.php')
    })

    $('.btn-login').click(function(e) {

        e.preventDefault()

        var dados = $('#form-login').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'src/usuario/modelo/login.php',
            async: true,
            data: dados,
            success: function(dados) {
                Swal.fire({
                    icon: dados.icone,
                    html: '<h2 style="color:white;">' + dados.mensagem + '</h2>',
                    background: 'rgb(39, 39, 61)',
                    showConfirmButton: false
                })

                if (dados.icone == 'success') {
                    $('.input').val('')
                    setTimeout(() => {
                        $(location).attr('href', 'menu.php')
                    }, 1150);
                }
            }
        });
    })
})