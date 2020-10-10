$(document).ready(function() {

    $('.seletor').on('change', function() {
        if ($('#rm').css('display') == 'none') {
            $('.img').attr('src', 'recursos/img/alunos.svg')
            $('#rm').show(490)
            $('#ra').hide()
        } else {
            $('.img').attr('src', 'recursos/img/professores.svg')
            $('#rm').hide()
            $('#ra').show(490)
        }
    })

    $('.btn-login').click(function() {
        window.open('src/principal/visao/menu.html', '_self')
    })
    $('.btn-cadastro').click(function() {
        window.open('src/usuario/visao/cadastro.html', '_self')
    })
})