$(document).ready(function() {
    $('.reagentes').on('click', 'button.btn-delete-reagente', function(e) {

        e.preventDefault()
        let id_reagente = `id_reagente=${$(this).attr('id')}`

        Swal.fire({
            html: '<h2 style="color:white;"> Deseja excluir esse reagente? </h2>',
            background: 'rgb(39, 39, 61)',
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            confirmButtonColor: '#d9534f',
            cancelButtonText: 'Não',
            cancelButtonColor: '#f0ad4e'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: 'POST',
                    dataType: 'json',
                    assync: true,
                    data: id_reagente,
                    url: '../modelo/delete-reagente.php',
                    success: function(dados) {
                        Swal.fire({
                            html: '<h2 style="color:white;"> ' + dados.msg + ' </h2>',
                            background: 'rgb(39, 39, 61)',
                            icon: dados.icone,
                            confirmButtonText: 'OK'
                        })
                        if (dados.icone == 'success') {
                            $('#modal-reagente').modal('hide')
                            $(".reagentes").empty()
                            $('.reagentes').load('list-reagente.html')
                        }
                    }
                })
            }
        })
    })
})