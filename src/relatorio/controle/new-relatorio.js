$(document).ready(function() {

    $('#equipamento').click(function() {
        $('.seletor-equipamento').toggleClass('d-none')
    })
    $('#vidraria').click(function() {
        $('.seletor-vidraria').toggleClass('d-none')
    })
    $('#reagente').click(function() {
        $('.seletor-reagente').toggleClass('d-none')
    })

    $('.btn-new-relatorio').click(function() {
        $('.container').empty()
        $('.container').load('form-relatorio.html')
    })

    $('.btn-select-equip').click(function() {
        $('#modal-equip').modal('show')
    })
    $('.btn-select-reag').click(function() {
        $('#modal-reag').modal('show')
    })
    $('.btn-select-vidr').click(function() {
        $('#modal-vidr').modal('show')
    })
    $('.btn-send').click(function(e) {

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
                }
            }
        });
    })
})