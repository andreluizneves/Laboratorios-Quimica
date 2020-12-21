$(document).ready(function() {

    $('.btn-update').click(function(e) {

        e.preventDefault()

        let dados = new FormData(document.getElementById('form-edit-vidraria'))

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/update-vidraria.php',
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
                    $('#laboratorio').empty()
                    $('#medida').empty()
                    $('.foto').val('')
                    $('#modal-vidraria').modal('hide')
                    $(".vidrarias").empty()
                    $('.vidrarias').load('list-vidraria.html')
                }
            }
        });
    })
})