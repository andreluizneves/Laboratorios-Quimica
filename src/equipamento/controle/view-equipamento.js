$(document).ready(function() {

    $('.equipamentos').on('click', 'button.btn-view-equipamento', function(e) {

        $('#modal-equipamento').modal('show')
        $('#laboratorio').empty()

        let id_equipamento = `id_equipamento=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            data: id_equipamento,
            async: true,
            dataType: 'json',
            url: '../modelo/view-equipamento.php',
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
                $(".secao-foto").addClass('d-none')
                $('#foto').attr('src', dado.dados.foto)
                $('#descricao').val(dado.dados.descricao)
                $('#descricao').attr('readonly', true)
                $('#descricao').attr('disabled', true)
                $('#numero_patrimonio').val(dado.dados.numero_patrimonio)
                $('#numero_patrimonio').attr('readonly', true)
                $('#numero_patrimonio').attr('disabled', true)
                $('#laboratorio').append(`<option value="${dado.dados.id_lab}">${lab}</option>`)
                $('#laboratorio').attr('readonly', true)
                $('#laboratorio').attr('disabled', true)
            }
        })
    })
})