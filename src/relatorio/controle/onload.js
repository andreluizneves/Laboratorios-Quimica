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
                    $('.icone-user').attr('src', '../../../recursos/img/icons/professores.svg')
                    $('.usuario:first').append("Professor(a): ", dados.nome)
                    $('.usuario:last').append("RA: ", dados.ra)
                    $('.container').empty()
                    $('.container').load('list-relatorio.html')
                } else {
                    $('.icone-user').attr('src', '../../../recursos/img/icons/alunos.svg')
                    $('.usuario:first').append("Aluno(a): ", dados.nome)
                    $('.usuario:last').append("RM: ", dados.rm)
                    $('.container').empty()
                    $('.container').load('list-relatorio.html')
                }
            }
        }
    })
    $('.btn-menu').click(function() {
        $(location).attr('href', '../../../menu.php')
    })
    $('.btn-editar-perfil').click(function() {
        $(location).attr('href', '../../../editar-perfil.php')
    })
    $('.btn-contato').click(function() {
        $(location).attr('href', '../../usuario/visao/contato.html')
    })
    $('.btn-sair').click(function() {
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../../usuario/modelo/logout.php',
            async: true,
        })
        $(location).attr('href', '../../../index.php')
    })
})