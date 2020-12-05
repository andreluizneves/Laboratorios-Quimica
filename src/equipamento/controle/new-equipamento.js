$(document).ready(function() {
    $('#table-equipamento').on('click', 'button.btn-visualizar', function(e) {})
    $('.btn-new-equipamento').click(function() {
        $('.container-fluid').empty()
        $('.container-fluid').load('form-equipamento.html')
    })
    $('.btn-view-equipamento').click(function() {
        $('.container-fluid').empty()
        $('.container-fluid').load('list-equipamento.html')
    })

    $('.btn-send').click(function(e) {
        e.preventDefault()

        var dados = $('#form-equipamento').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/new-equipamento.php',
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