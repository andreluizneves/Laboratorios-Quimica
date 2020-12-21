$(document).ready(function() {

    $('.vidrarias').on('click', 'button.btn-view-vidraria', function(e) {

        $('#modal-vidraria').modal('show')
        $('#laboratorio').empty()

        let vidrarias = `id_vidraria=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            data: vidrarias,
            async: true,
            dataType: 'json',
            url: '../modelo/view-vidraria.php',
            success: function(dado) {
                if (dado.dados.id_lab == 1) {
                    var lab = 'Externo'
                } else if (dado.dados.id_lab == 2) {
                    var lab = 'Interno'
                } else {
                    var lab = 'Ambos'
                }
                $(".modal-title").empty()
                $(".modal-title").text(`Visualizando Equipamento: ${dado.dados.nome}`)
                $('.btn-fechar').removeClass('d-none')
                $('.btn-cancelar').addClass('d-none')
                $('.btn-update').addClass('d-none')
                $('#foto').attr('src', dado.dados.foto)
                $('#descricao').val(dado.dados.descricao)
                $(".secao-foto").addClass('d-none')
                $('#descricao').attr('readonly', true)
                $('#descricao').attr('disabled', true)
                $('#quantidade').val(dado.dados.quantidade + ' unidades')
                $('#quantidade').attr('readonly', true)
                $('#quantidade').attr('disabled', true)
                $('#laboratorio').append(`<option value="${dado.dados.id_lab}">${lab}</option>`)
                $('#laboratorio').attr('readonly', true)
                $('#laboratorio').attr('disabled', true)
            }
        })
    })
})