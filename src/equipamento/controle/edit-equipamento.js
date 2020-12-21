$(document).ready(function() {

    $('.equipamentos').on('click', 'button.btn-edit-equipamento', function(e) {

        $('#modal-equipamento').modal('show')

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
                    var lab2 = 'Interno'
                    var id_lab2 = 2
                    var lab3 = 'Ambos'
                    var id_lab3 = 3

                } else if (dado.dados.id_lab == 2) {
                    var lab = 'Interno'
                    var lab2 = 'Externo'
                    var id_lab2 = 1
                    var lab3 = 'Ambos'
                    var id_lab3 = 3
                } else {
                    var lab = 'Ambos'
                    var lab2 = 'Interno'
                    var id_lab2 = 2
                    var lab2 = 'Externo'
                    var id_lab2 = 1
                }

                $("#id_equipamento").val(dado.dados.id_equipamento)
                $(".modal-title").empty()
                $(".modal-title").append(`Editando o Equipamento: 
                <input type="text" name="nome" class="text-center edit-nome" value="${dado.dados.nome}" name="${dado.dados.nome}">`)
                $('.btn-fechar').addClass('d-none')
                $('.btn-cancelar').removeClass('d-none')
                $('.btn-update').removeClass('d-none')
                $(".secao-foto").removeClass('d-none')
                $('#foto').attr('src', dado.dados.foto)
                $('#descricao').attr('readonly', false)
                $('#descricao').attr('disabled', false)
                $('#descricao').val(dado.dados.descricao)
                $('#numero_patrimonio').attr('readonly', false)
                $('#numero_patrimonio').attr('disabled', false)
                $('#numero_patrimonio').val(dado.dados.numero_patrimonio)
                $('#laboratorio').empty()
                $("#laboratorio").attr('readonly', false)
                $("#laboratorio").attr('disabled', false)
                $('#laboratorio').append(`<option value = "${dado.dados.id_lab}">${lab}</option>
                                          <option value = "${id_lab2}">${lab2}</option>
                                          <option value = "${id_lab3}">${lab3}</option>`)
            }
        })
    })
})