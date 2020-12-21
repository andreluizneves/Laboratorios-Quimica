$(document).ready(function() {

    $('.vidrarias').on('click', 'button.btn-edit-vidraria-quebrada', function(e) {

        $('#modal-vidraria-quebrada').modal('show')
        $('#relatorio').empty()

        let id_vidraria_quebrada = `id_vidraria_quebrada=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            data: id_vidraria_quebrada,
            async: true,
            dataType: 'json',
            url: '../modelo/view-vidraria-quebrada.php',
            success: function(dado2) {
                if (dado2.dados.titulo == null) {
                    dado2.dados.id_relatorio = null
                    dado2.dados.titulo = 'Não quebrado em aula'.toUpperCase()
                }

                let id_relatorio_vidraria = `id_relatorio_vidraria=${dado2.dados.id_relatorio}`

                $.ajax({

                    type: 'POST',
                    data: id_relatorio_vidraria,
                    async: true,
                    dataType: 'json',
                    url: '../modelo/list-relatorio-v-edit.php',
                    success: function(retorno) {

                        if (dado2.dados.titulo != 'NÃO QUEBRADO EM AULA') {
                            var vazio = null
                            $("#relatorio").append(`<option value="${dado2.dados.id_relatorio}">${dado2.dados.titulo}</option>`)

                            for (const dado of retorno.dados) {
                                $("#relatorio").append(`<option value="${dado.id_relatorio}">${dado.titulo}</option>`)
                            }

                            $("#relatorio").append(`<option value="${vazio}">NÃO QUEBRADO EM AULA</option>`)
                        } else {
                            $("#relatorio").append(`<option value="${dado2.dados.id_relatorio}">${dado2.dados.titulo}</option>`)

                            for (const dado of retorno.dados) {
                                $("#relatorio").append(`<option value="${dado.id_relatorio}">${dado.titulo}</option>`)
                            }
                        }
                    }
                })

                $("#id_vidraria_quebrada").val(dado2.dados.id_vidraria_quebrada)
                $(".modal-title").empty()
                $(".modal-title").append(`Editando a Vidraria Quebrada: 
                <input type="text" name="nome" class="text-center edit-nome-q" value="${dado2.dados.nome}" name="${dado2.dados.nome}">`)
                $('.btn-fechar').addClass('d-none')
                $('.btn-cancelar').removeClass('d-none')
                $('.btn-update-quebrada').removeClass('d-none')
                $(".foto-q").removeClass('d-none')
                $(".lare").text('Título do Relatório')
                $('#foto2').attr('src', dado2.dados.foto)
                $(".label-foto").removeClass('d-none')
                $('#quantidade2').val(dado2.dados.quantidade)
                $('#quantidade2').attr('readonly', false)
                $('#quantidade2').attr('disabled', false)
                $('#relatorio').attr('readonly', false)
                $('#relatorio').attr('disabled', false)
            }
        })
    })
})