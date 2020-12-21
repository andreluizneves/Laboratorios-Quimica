$(document).ready(function() {
    $('.btn-form').click(function() {
        $('.vidrarias').empty()
        $('.vidrarias').load('form-vidraria.html')
        $('.col-form').addClass('d-none')
        $('.col-list').removeClass('d-none')
        $('.text-titulo').text('NOVA VIDRARIA')
        $('.conteudo').addClass('p-3')
        $('.conteudo').addClass('m-3')
        $("#pesquisa").attr('disabled', true)
        $("#pesquisa").val('')
        $("#pesquisa").css('background-colo', 'grey')
    })
    $('.btn-list').click(function() {
        $('.vidrarias').empty()
        $('.vidrarias').load('list-vidraria.html')
        $('.col-form').removeClass('d-none')
        $('.col-list').addClass('d-none')
        $('.text-titulo').text('VIDRARIA')
        $('.conteudo').removeClass('p-3')
        $('.conteudo').removeClass('m-3')
        $("#pesquisa").attr('disabled', false)
        $("#pesquisa").val('')
        $("#pesquisa").css('background-colo', 'white')
    })
    $('.btn-form-q').click(function() {
        $('.vidrarias').empty()
        $('.vidrarias').load('form-vidraria-quebrada.html')
        $('.col-form-q').addClass('d-none')
        $('.col-list-q').removeClass('d-none')
        $('.text-titulo').text('NOVA VIDRARIA QUEBRADA')
        $('.conteudo').addClass('p-3')
        $('.conteudo').addClass('m-3')
        $("#pesquisa-quebrada").attr('disabled', true)
        $("#pesquisa-quebrada").val('')
        $("#pesquisa-quebrada").css('background-colo', 'grey')

    })
    $('.btn-list-q').click(function() {
        $('.vidrarias').empty()
        $('.vidrarias').load('list-vidraria-quebrada.html')
        $('.col-form-q').removeClass('d-none')
        $('.col-list-q').addClass('d-none')
        $('.text-titulo').text('VIDRARIAS QUEBRADAS')
        $('.conteudo').removeClass('p-3')
        $('.conteudo').removeClass('m-3')
        $("#pesquisa-quebrada").attr('disabled', false)
        $("#pesquisa-quebrada").val('')
        $("#pesquisa-quebrada").css('background-colo', 'white')
    })
    $('.btn-trocar').click(function() {
        $('.bg-pesquisa').addClass('d-none')
        $('.quebrada').removeClass('d-none')
        $('.vidrarias').empty()
        $('.col-form-q').removeClass('d-none')
        $('.col-list-q').addClass('d-none')
        $('.text-titulo').text('VIDRARIAS QUEBRADAS')
        $('.vidrarias').load('list-vidraria-quebrada.html')
    })
    $('.btn-trocar-q').click(function() {
        $('.bg-pesquisa').removeClass('d-none')
        $('.quebrada').addClass('d-none')
        $('.text-titulo').text('VIDRARIAS')
        $('.col-list').addClass('d-none')
        $('.col-form').removeClass('d-none')
        $('.vidrarias').empty()
        $('.vidrarias').load('list-vidraria.html')
    })

    $('.vidrarias').on('click', 'button.btn-send', function(e) {

        e.preventDefault()

        let dados = new FormData(document.getElementById('form-vidraria'))

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/new-vidraria.php',
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