$(document).ready(function() {

    $('.btn-form').click(function() {
        $('.equipamentos').empty()
        $('.equipamentos').load('form-equipamento.html')
        $('.col-form').addClass('d-none')
        $('.col-btn').addClass('d-none')
        $('.col-list').removeClass('d-none')
        $('.text-titulo').text('NOVO EQUIPAMENTO')
        $('.conteudo').addClass('p-3')
        $('.conteudo').addClass('m-3')
        $("#pesquisa").attr('disabled', true)
        $("#pesquisa").val('')
        $("#pesquisa").css('background-colo', 'grey')
    })
    $('.btn-list').click(function() {
        $('.equipamentos').empty()
        $('.equipamentos').load('list-equipamento.html')
        $('.col-form').removeClass('d-none')
        $('.col-list').addClass('d-none')
        $('.col-btn').removeClass('d-none')
        $('.text-titulo').text('EQUIPAMENTO')
        $('.conteudo').removeClass('p-3')
        $('.conteudo').removeClass('m-3')
        $("#pesquisa").attr('disabled', false)
        $("#pesquisa").val('')
        $("#pesquisa").css('background-colo', 'white')
    })
    $('.equipamentos').on('click', 'button.btn-send', function(e) {

        e.preventDefault()

        let dados = new FormData(document.getElementById('form-equipamento'))

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/new-equipamento.php',
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