window.onload = function() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/vidraria.php',
        async: true,
        success: function(dados) {
            if (dados.logado == 'não') {
                $(location).attr('href', '../../../index.html')
            } else {
                if (dados.tipo_user == 'professor(a)') {
                    $('.icone-user').attr('src', '../../../recursos/img/professores.svg')
                    $('.usuario:first').append("Professor(a): ", dados.nome)
                    $('.usuario:last').append("RA: ", dados.ra)
                } else {
                    $('.icone-user').attr('src', '../../../recursos/img/alunos.svg')
                    $('.usuario:first').append("Aluno(a): ", dados.nome)
                    $('.usuario:last').append("RM: ", dados.rm)
                    $('.editor').remove()
                }
            }
        }
    })
}