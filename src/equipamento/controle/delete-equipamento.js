$(document).ready(function() {
    $('.equipamentos').on('click', 'button.btn-delete-equipamento', function(e) {

        e.preventDefault()
        let id_equipamento = `id_equipamento=${$(this).attr('id')}`

        Swal.fire({
            html: '<h2 style="color:white;"> Deseja excluir esse equipamento? </h2>',
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
                    data: id_equipamento,
                    url: '../modelo/delete-equipamento.php',
                    success: function(dados) {
                        Swal.fire({
                            html: '<h2 style="color:white;"> ' + dados.msg + ' </h2>',
                            background: 'rgb(39, 39, 61)',
                            icon: dados.icone,
                            confirmButtonText: 'OK'
                        })
                        if (dados.icone == 'success') {
                            $('#modal-equipamento').modal('hide')
                            $(".equipamentos").empty()
                            $('.equipamentos').load('list-equipamento.html')
                        }
                    }
                })
            }
        })
    })
})