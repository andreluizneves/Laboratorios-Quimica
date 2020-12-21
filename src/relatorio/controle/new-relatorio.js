$(document).ready(function() {

    $('.relatorios').on('click', 'button.btn-select-equipamento', function() {
        $("#modal-equipamento").modal('show')
    })
    $('.relatorios').on('click', 'button.btn-select-reagente', function() {
        $("#modal-reagente").modal('show')
    })
    $('.relatorios').on('click', 'button.btn-select-vidraria', function() {
        $("#modal-vidraria").modal('show')
    })
    $('.btn-form').click(function() {
        $('.relatorios').empty()
        $('.relatorios').load('form-relatorio.html')
        $('.col-form').addClass('d-none')
        $('.col-list').removeClass('d-none')
        $('.text-titulo').text('NOVO RELATÓRIO')
        $("#pesquisa").attr('disabled', true)
        $("#pesquisa").val('')
        $("#pesquisa").css('background-colo', 'grey')
        $('.conteudo').addClass('p-3')
        $('.conteudo').addClass('m-3')
    })
    $('.btn-list').click(function() {
        $('.relatorios').empty()
        $('.relatorios').load('list-relatorio.html')
        $('.col-form').removeClass('d-none')
        $('.col-list').addClass('d-none')
        $('.text-titulo').text('RELATÓRIO')
        $("#pesquisa").val('')
        $("#pesquisa").css('background-colo', 'white')
        $("#pesquisa").attr('disabled', false)
        $('.conteudo').removeClass('p-3')
        $('.conteudo').removeClass('m-3')
    })

    $('.relatorios').on('click', 'button.btn-relatar', function(e) {

        e.preventDefault()
        var dados = $('#form-relatorio').serialize();
        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/new-relatorio.php',
            async: true,
            data: dados,
            success: function(dados) {
                Swal.fire({
                    icon: dados.icone,
                    html: '<h2 style="color:white;">' + dados.msg + '</h2>',
                    background: 'rgb(39, 39, 61)',
                })
                if (dados.icone == 'success') {
                    $('.input').val('')
                    $('.relatorios').empty()
                    $('.relatorios').load('form-relatorio.html')
                }
            }
        });
    })
})