$(document).ready(function() {

    $('.reagentes').on('click', 'button.btn-view-reagente', function(e) {

        $('#modal-reagente').modal('show')
        $('#laboratorio').empty()

        let reagentes = `id_reagente=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            data: reagentes,
            async: true,
            dataType: 'json',
            url: '../modelo/view-reagente.php',
            success: function(dado) {
                if (dado.dados.id_lab == 1) {
                    var lab = 'Externo'
                } else if (dado.dados.id_lab == 2) {
                    var lab = 'Interno'
                } else {
                    var lab = 'Ambos'
                }
                $(".modal-title").empty()
                $(".modal-title").text(`Visualizando reagente: ${dado.dados.nome}`)
                $('.btn-fechar').removeClass('d-none')
                $('.btn-cancelar').addClass('d-none')
                $('.btn-update').addClass('d-none')
                $(".secao-foto").addClass('d-none')
                $('#foto').attr('src', dado.dados.foto)
                $('#quantidade').val(dado.dados.quantidade)
                $('#quantidade').attr('readonly', true)
                $('#quantidade').attr('disabled', true)
                $('#medida').attr('disabled', true)
                $('#medida').attr('readonly', true)
                $('#medida').append(`<option value="${dado.dados.medida}">${dado.dados.medida}</option>`)
                $('#numermedidao_patrimonio').attr('disabled', true)
                $('#laboratorio').append(`<option value="${dado.dados.id_lab}">${lab}</option>`)
                $('#laboratorio').attr('readonly', true)
                $('#laboratorio').attr('disabled', true)
            }
        })
    })
})