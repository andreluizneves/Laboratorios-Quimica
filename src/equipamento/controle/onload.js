$(document).ready(function() {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/onload.php',
        async: true,
        success: function(dados) {
            if (dados.logado == 'não') {
                $(location).attr('href', '../../../index.php')
            } else {
                if (dados.tipo_user == 'professor(a)') {
                    $('.fotoUser').attr('src', '../../../recursos/img/icons/professores.svg')
                    $('.nomeUser').append("Professor(a): ", dados.nome)
                    $('.loginUser').append("RA: ", dados.ra)
                } else {
                    $('.fotoUser').attr('src', '../../../recursos/img/icons/alunos.svg')
                    $('.nomeUser').append("Aluno(a): ", dados.nome)
                    $('.loginUser').append("RM: ", dados.rm)
                    $(".btn-form").addClass('d-none')
                    $(".btn-reocar").addClass('d-none')
                }
            }
        }
    })
    $('.caixa').click(function() {
        $('#sidebar2').toggleClass('active')
        $('#seta2').toggleClass('d-none')
        $('#seta').toggleClass('d-block')
    })
    $('.btn-menu').click(function() {
        $(location).attr('href', '../../../menu.php')
    })
    $('.btn-edit-perfil').click(function() {
        $(location).attr('href', '../../../editar-perfil.php')
    })
    $('.btn-reagentes').click(function() {
        $(location).attr('href', '../../reagente/visao/reagente.html')
    })
    $('.btn-vidrarias').click(function() {
        $(location).attr('href', '../../vidraria/visao/vidraria.html')
    })
    $('.btn-relatorios').click(function() {
        $(location).attr('href', '../../relatorio/visao/relatorio.html')
    })
    $('.btn-contato').click(function() {
        $(location).attr('href', '../../usuario/visao/contato.html')
    })
    $('.btn-sair').click(function() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../../usuario/modelo/logout.php'
        })
        $(location).attr('href', '../../../index.php')
    })
})