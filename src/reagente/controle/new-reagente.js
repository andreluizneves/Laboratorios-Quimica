$(document).ready(function() {
    $('#table-cliente').on('click', 'button.btn-visualizar', function(e) {})
    $('.btn-new-reagente').click(function() {
        $('.container-fluid').empty()
        $('.container-fluid').load('form-reagente.html')
    })
    $('.btn-view-reagente').click(function() {
        $('.container-fluid').empty()
        $('.container-fluid').load('list-reagente.html')
    })

    $('.btn-send').click(function(e) {

        e.preventDefault()

        var dados = $('#form-reagente').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/new-reagente.php',
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