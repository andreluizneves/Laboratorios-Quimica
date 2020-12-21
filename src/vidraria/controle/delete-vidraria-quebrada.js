$(document).ready(function() {
    $('.vidrarias').on('click', 'button.btn-delete-vidraria-quebrada', function(e) {

        e.preventDefault()
        let id_vidraria_quebrada = `id_vidraria_quebrada=${$(this).attr('id')}`

        Swal.fire({
            html: '<h2 style="color:white;"> Deseja excluir essa Vidraria Quebrada? </h2>',
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
                    data: id_vidraria_quebrada,
                    url: '../modelo/delete-vidraria-quebrada.php',
                    success: function(dados) {
                        Swal.fire({
                            html: '<h2 style="color:white;"> ' + dados.msg + ' </h2>',
                            background: 'rgb(39, 39, 61)',
                            icon: dados.icone,
                            confirmButtonText: 'OK'
                        })
                        if (dados.icone == 'success') {
                            $(".vidrarias").empty()
                            $('.vidrarias').load('list-vidraria-quebrada.html')
                        }
                    }
                })
            }
        })
    })
})