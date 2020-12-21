$(document).ready(function() {

    $('.vidrarias').on('click', 'button.btn-send-quebrada', function(e) {

        e.preventDefault()

        let dados = new FormData(document.getElementById('form-vidraria-quebrada'))

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/new-vidraria-quebrada.php',
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