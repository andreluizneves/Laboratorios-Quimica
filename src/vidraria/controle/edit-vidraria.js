$(document).ready(function() {

    $('.vidrarias').on('click', 'button.btn-edit-vidraria', function(e) {

        $('#modal-vidraria').modal('show')

        let id_vidraria = `id_vidraria=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            data: id_vidraria,
            async: true,
            dataType: 'json',
            url: '../modelo/view-vidraria.php',
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

                $("#id_vidraria").val(dado.dados.id_vidraria)
                $(".modal-title").empty()
                $(".modal-title").append(`Editando a Vidraria: 
                <input type="text" name="nome" class="text-center edit-nome" value='${dado.dados.nome}' name="${dado.dados.nome}">`)
                $('.btn-fechar').addClass('d-none')
                $('.btn-cancelar').removeClass('d-none')
                $(".secao-foto").removeClass('d-none')
                $('.btn-update').removeClass('d-none')
                $(".foto").removeClass('d-none')
                $('#foto').attr('src', dado.dados.foto)
                $('#quantidade').val(dado.dados.quantidade)
                $('#quantidade').attr('readonly', false)
                $('#quantidade').attr('disabled', false)
                $('#descricao').attr('readonly', false)
                $('#descricao').attr('disabled', false)
                $('#descricao').val(dado.dados.descricao)
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