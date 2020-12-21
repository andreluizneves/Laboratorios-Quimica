$(document).ready(function() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/dados.php',
        async: true,
        success: function(dados) {
            $('.nome').val(`${dados.nome}`)
            $('.email').val(`${dados.email}`)
            $('.ra').val(`${dados.ra}`)
        }
    });
    $('.btn-permitir-edicao').click(function() {
        $(".ra, .nome, .email").prop('disabled', function() {
            return !$(this).prop('disabled');
        });
    })
    $('.btn-editar-perfil').click(function(e) {
        e.preventDefault()

        var dados = $('#form-edit').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/editar-perfil.php',
            data: dados,
            async: true,
            success: function(dados) {
                $('.nome').val(`${dados.nome}`)
                $('.email').val(`${dados.email}`)
                $('.ra').val(`${dados.ra}`)
            }
        });
    })
    $('.caixa').click(function() {
        $('#sidebar2').toggleClass('active')
        $('#seta2').toggleClass('d-none')
        $('#seta').toggleClass('d-block')
    })
    $('.btn-menu').click(function() {
        $(location).attr('href', 'menu.php')
    })
    $('.btn-reagentes').click(function() {
        $(location).attr('href', 'src/reagente/visao/reagente.html')
    })
    $('.btn-vidrarias').click(function() {
        $(location).attr('href', 'src/vidraria/visao/vidraria.html')
    })
    $('.btn-relatorios').click(function() {
        $(location).attr('href', 'src/relatorio/visao/relatorio.html')
    })
    $('.btn-contato').click(function() {
        $(location).attr('href', 'src/usuario/visao/contato.html')
    })
    $('.btn-sair').click(function() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../../usuario/modelo/logout.php'
        })
        $(location).attr('href', 'index.php')
    })
})