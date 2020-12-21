$(document).ready(function() {

    $('.btn-update').click(function(e) {

        e.preventDefault()

        var dados = $('#form-edit-relatorio').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/update-relatorio.php',
            data: dados,
            success: function(dados) {
                Swal.fire({
                    icon: dados.icone,
                    html: '<h2 style="color:white;">' + dados.msg + '</h2>',
                    background: 'rgb(39, 39, 61)',
                })
                if (dados.icone == "success") {
                    $("#modal-relatorio").modal('hide')
                    $('.relatorios').load('list-relatorio.html')
                }
            }
        });
    })
})