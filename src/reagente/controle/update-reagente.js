$(document).ready(function() {

    $('.btn-update').click(function(e) {

        e.preventDefault()

        let dados = new FormData(document.getElementById('form-edit-reagente'))

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/update-reagente.php',
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
                    $('.input-foto').val('')
                    $('#modal-reagente').modal('hide')
                    $(".reagentes").empty()
                    $('.reagentes').load('list-reagente.html')
                }
            }
        });
    })
})