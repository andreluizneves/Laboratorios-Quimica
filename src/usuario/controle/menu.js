$(document).ready(function() {
    $('.caixa').click(function() {
        $('#sidebar2').toggleClass('active')
        $('#seta2').toggleClass('d-none')
        $('#seta').toggleClass('d-block')
    })
    $('.btn-equipamentos').click(function() {
        $(location).attr('href', 'src/equipamento/visao/equipamento.html')
    })
    $('.btn-edit-perfil').click(function() {
        $(location).attr('href', 'editar-perfil.php')
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
            url: 'src/usuario/modelo/logout.php'
        })
        $(location).attr('href', 'index.php')
    })
})