$(document).ready(function() {

    $('.btn-form').click(function() {
        $('.reagentes').empty()
        $('.reagentes').load('form-reagente.html')
        $('.col-form').addClass('d-none')
        $('.col-list').removeClass('d-none')
        $('.text-titulo').text('NOVO REAGENTE')
        $('.conteudo').addClass('p-3')
        $('.conteudo').addClass('m-3')
        $("#pesquisa").attr('disabled', true)
        $("#pesquisa").val('')
        $("#pesquisa").css('background-colo', 'grey')
    })
    $('.btn-list').click(function() {
        $('.reagentes').empty()
        $('.reagentes').load('list-reagente.html')
        $('.col-form').removeClass('d-none')
        $('.col-list').addClass('d-none')
        $('.text-titulo').text('REAGENTE')
        $('.conteudo').removeClass('p-3')
        $('.conteudo').removeClass('m-3')
        $("#pesquisa").attr('disabled', false)
        $("#pesquisa").val('')
        $("#pesquisa").css('background-colo', 'white')
    })

    $('.reagentes').on('click', 'button.btn-send', function(e) {

        e.preventDefault()

        let dados = new FormData(document.getElementById('form-reagente'))

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/new-reagente.php',
            async: true,
            data: dados,
            nimeType: 'multipart/form-data',
            cache: false,
            contentType: false,
            processData: false,
            success: function(dados) {
                Swal.fire({
                    icon: dados.icone,
                    html: '<h2 style="color:white;">' + dados.msg + '</h2>',
                    background: 'rgb(39, 39, 61)',
                })
                if (dados.icone == 'success') {
                    $('.input').val('')
                }
            }
        });
    })
})