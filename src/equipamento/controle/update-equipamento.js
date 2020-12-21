$(document).ready(function() {

    $('.btn-update').click(function(e) {

        e.preventDefault()

        let dados = new FormData(document.getElementById('form-edit-equipamento'))

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/update-equipamento.php',
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
                    $(".foto").val('')
                    $('#laboratorio').empty()
                    $('#modal-equipamento').modal('hide')
                    $(".equipamentos").empty()
                    $('.equipamentos').load('list-equipamento.html')
                }
            }
        });
    })
})