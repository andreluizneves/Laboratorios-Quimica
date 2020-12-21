$(document).ready(function() {

    $('.btn-update-quebrada').click(function(e) {

        e.preventDefault()

        let dados = new FormData(document.getElementById('form-edit-vidraria-quebrada'))

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/update-vidraria-quebrada.php',
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
                if (dados.icone == "success") {
                    $('#relatorio').empty()
                    $('#mquantidade').empty()
                    $('.foto-q').val('')
                    $('#modal-vidraria-quebrada').modal('hide')
                    $(".vidrarias").empty()
                    $('.vidrarias').load('list-vidraria-quebrada.html')
                }
            }
        });
    })
})