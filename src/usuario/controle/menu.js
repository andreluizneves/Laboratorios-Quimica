$(document).ready(function() {

    $('.btn-menu').click(function() {
        $(location).attr('href', '#topo')
    })
    $('.btn-edit-perfil').click(function() {
        $(location).attr('href', '../../../editar-perfil.php')
    })
    $('.btn-contato').click(function() {
        $(location).attr('href', 'src/usuario/visao/contato.html')
    })
    $('.btn-sair').click(function() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: 'src/usuario/modelo/logout.php',
            async: true,
        })
        $(location).attr('href', 'index.php')
    })
})