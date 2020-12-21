$(document).ready(function() {

    $('.reagentes').on('click', 'button.btn-edit-reagente', function(e) {

        $('#modal-reagente').modal('show')

        let id_reagente = `id_reagente=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            data: id_reagente,
            async: true,
            dataType: 'json',
            url: '../modelo/view-reagente.php',
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
                    var lab3 = 'Interno'
                    var id_lab3 = 2
                    var lab2 = 'Externo'
                    var id_lab2 = 1
                }

                if (dado.dados.medida == 'g') {
                    var i = 'gramas (g)'
                    var val_i = 'g'
                    var i2 = 'mililitros (ml)'
                    var val_i2 = 'ml'
                    var i3 = 'litros (L)'
                    var val_i3 = 'L'
                } else if (dado.dados.medida == 'ml') {
                    var i = 'mililitros (ml)'
                    var val_i = 'ml'
                    var i2 = 'gramas (g)'
                    var val_i2 = 'g'
                    var i3 = 'litros (L)'
                    var val_i3 = 'L'
                } else {
                    var i = 'Litros (L)'
                    var val_i = 'L'
                    var i2 = 'mililitros (ml)'
                    var val_i2 = 'ml'
                    var i3 = 'gramas (g)'
                    var val_i3 = 'g'
                }

                $("#id_reagente").val(dado.dados.id_reagente)
                $(".modal-title").empty()
                $(".modal-title").append(`Editando o Reagente: 
                <input type="text" name="nome" class="text-center edit-nome" value="${dado.dados.nome}" name="${dado.dados.nome}">`)
                $('.btn-fechar').addClass('d-none')
                $('.btn-cancelar').removeClass('d-none')
                $('.btn-update').removeClass('d-none')
                $(".secao-foto").removeClass('d-none')
                $('#foto').attr('src', dado.dados.foto)
                $('#quantidade').val(dado.dados.quantidade)
                $('#quantidade').attr('readonly', false)
                $('#quantidade').attr('disabled', false)
                $('#medida').empty()
                $('#medida').attr('readonly', false)
                $('#medida').attr('disabled', false)
                $('#medida').append(`<option value="${val_i}">${i}</option>
                                     <option value="${val_i2}">${i2}</option>
                                     <option value="${val_i3}">${i3}</option>`)

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