$(document).ready(function() {

    $('.relatorios').on('click', 'button.btn-view-relatorio', function(e) {

        $(".modal-title").empty()
        $('#modal-relatorio').modal('show')
        $("#laboratorio").attr('disabled', true)
        $("#laboratorio").attr('readonly', true)

        $("#tempo").attr('disabled', true)
        $("#tempo").attr('readonly', true)

        $("#descricao").attr('disabled', true)
        $("#descricao").attr('readonly', true)

        $("#data").attr('readonly', true)
        $("#hora").attr('readonly', true)
        $("#descricao").attr('readonly', true)
        $("#data").attr('disabled', true)
        $("#hora").attr('disabled', true)

        var id_relatorio = `id_relatorio=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            data: id_relatorio,
            async: true,
            dataType: 'json',
            url: '../modelo/view-relatorio.php',
            success: function(dado) {
                if (dado.dados.id_lab == 1) {
                    var lab = 'Externo'
                } else if (dado.dados.id_lab == 2) {
                    var lab = 'Interno'
                } else {
                    var lab = 'Ambos'
                }
                var hora = dado.dados.data_hora.substring(11, 16)
                var data = dado.dados.data_hora.substring(0, 10)
                $("#data").val(data)
                $("#hora").val(hora)
                $(".modal-title").append(`Título do Relatório:  ${dado.dados.titulo}`)
                $("#laboratorio").append(`<option value=${dado.dados.id_lab}>${lab}</option>`)
                $("#tempo").append(`<option value=${dado.dados.tempo}>${dado.dados.tempo}</option>`)
                $("#descricao").val(dado.dados.descricao)
                $("#data_hora").val(dado.dados.data_hora)
                $(".btn-fechar").removeClass('d-none')
                $(".btn-cancelar").addClass("d-none")
                $(".btn-update").addClass("d-none")
                $("#id_relatorio").val(dado.dados.id_relatorio)
            }
        })
        $.ajax({
            dataType: 'json',
            type: 'POST',
            data: id_relatorio,
            url: '../modelo/tabela-equipamento.php',
            success: function(tabela) {

                $('.itens-equipamentos').empty()
                if (tabela.status == 'ok') {
                    for (const equipamento of tabela.dados) {
                        $(".itens-equipamentos").append(`
                        <tr role="row" class="bg-light">
                            <td style="padding:5px;">
                                ${equipamento.nome}
                            </td>
                        </tr>       
                    `)
                    }
                }
            }
        })
        $.ajax({
            dataType: 'json',
            type: 'POST',
            data: id_relatorio,
            url: '../modelo/tabela-vidraria.php',
            success: function(tabela) {
                $('.itens-vidrarias').empty()
                if (tabela.status == 'ok') {

                    for (const vidraria of tabela.dados) {
                        $(".itens-vidrarias").append(`
                        <tr role="row" class="bg-light">
                            <td style="padding:5px;">
                                ${vidraria.nome}
                            </td>
                        </tr>       
                    `)
                    }
                }
            }
        })
        $.ajax({
            dataType: 'json',
            type: 'POST',
            data: id_relatorio,
            url: '../modelo/tabela-reagente.php',
            success: function(tabela) {

                $('.itens-reagentes').empty()
                if (tabela.status == 'ok') {
                    for (const reagente of tabela.dados) {
                        $(".itens-reagentes").append(`
                        <tr role="row" class="bg-light">
                            <td style="padding:5px;">
                                ${reagente.nome} | ${reagente.quantidade}${reagente.medida}
                            </td>
                        </tr>       
                    `)
                    }
                }
            }
        })
    })
})