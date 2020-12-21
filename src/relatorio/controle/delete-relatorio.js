$(document).ready(function() {
    $('.relatorios').on('click', 'button.btn-delete-relatorio', function(e) {

        e.preventDefault()
        let id_relatorio = `id_relatorio=${$(this).attr('id')}`

        Swal.fire({
            html: '<h2 style="color:white;"> Deseja excluir esse Relatório e seus registrados relacionados? </h2>',
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
                    data: id_relatorio,
                    url: '../modelo/delete-relatorio.php',
                    success: function(dados) {
                        Swal.fire({
                            html: '<h2 style="color:white;"> ' + dados.msg + ' </h2>',
                            background: 'rgb(39, 39, 61)',
                            icon: dados.icone,
                            confirmButtonText: 'OK'
                        })
                        if (dados.icone == 'success') {
                            $(".relatorios").empty()
                            $('.relatorios').load('list-relatorio.html')
                        }
                    }
                })
            }
        })
    })
})