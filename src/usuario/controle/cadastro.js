$(document).ready(function() {

    $('.seletor').on('change', function() {
        if ($('#rm').css('display') == 'none') {
            $('.img').attr('src', '../../../recursos/img/alunos.svg')
            $('#rm').show(490)
            $('#ra').hide()
        } else {
            $('.img').attr('src', '../../../recursos/img/professores.svg')
            $('#rm').hide()
            $('#ra').show(490)
        }
    })

    $('.btn-cadastro').click(function(e) {

        e.preventDefault

        var dados = $('#form-cadastro').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/cadastro.php',
            async: true,
            data: dados,
            success: function(dados) {
                Swal.fire({
                    icon: 'success',
                    html: '<h1 style="color:white;">Cadastrado com êxito</h1>',
                    background: 'rgb(39, 39, 61)',
                })
                $('.input').val('')
            }
        });
    })
})