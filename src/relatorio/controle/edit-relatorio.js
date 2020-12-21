$(document).ready(function() {

    $('.relatorios').on('click', 'button.btn-edit-relatorio', function(e) {

        $("#tempo").empty()
        $("#laboratorio").empty()
        $("#laboratorio").attr('disabled', false)
        $("#laboratorio").attr('readonly', false)
        $(".modal-title").empty()
        $("#tempo").attr('disabled', false)
        $("#tempo").attr('readonly', false)
        $("#descricao").attr('disabled', false)
        $("#descricao").attr('readonly', false)
        $("#data").attr('readonly', false)
        $("#data").attr('disabled', false)
        $("hora").attr('disabled', false)
        $("hora").attr('readonly', false)
        $("#laboratorio").val('')
        $("#tempo").val('')
        $("#hora").attr('readonly', false)
        $("#hora").attr('disabled', false)
        $(".btn-fechar").addClass('d-none')
        $(".btn-update").removeClass("d-none")
        $(".btn-cancelar").removeClass("d-none")

        $('#modal-relatorio').modal('show')

        let id_relatorio = `id_relatorio=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            data: id_relatorio,
            async: true,
            dataType: 'json',
            url: '../modelo/view-relatorio.php',
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
                if (dado.dados.tempo == '00:50:00') {
                    var tempo2 = '01:40:00'
                    var tempo3 = '02:40:00'
                    var tempo4 = '03:30:00'
                } else if (dado.dados.tempo == '01:40:00') {
                    var tempo2 = '00:50:00'
                    var tempo3 = '02:40:00'
                    var tempo4 = '03:30:00'
                } else if (dado.dados.tempo == '02:30:00') {
                    var tempo2 = '00:50:00'
                    var tempo3 = '01:40:00'
                    var tempo4 = '03:30:00'
                } else {
                    var tempo2 = '00:50:00'
                    var tempo3 = '01:40:00'
                    var tempo4 = '02:40:00'
                }
                var hora = dado.dados.data_hora.substring(11, 16)
                var data = dado.dados.data_hora.substring(0, 10)
                $("#id_relatorio").val(dado.dados.id_relatorio)
                $(".modal-title").append(`Título do Relatório: <input type="text" name="titulo" class="text-center" style="display: unset !important; width: 320px !important; font-weight:bold;" value="${dado.dados.titulo}" name="${dado.dados.titulo}">`)
                $("#laboratorio").append(`<option value=${dado.dados.id_lab}>${lab}</option>
                                          <option value=${id_lab2}>${lab2}</option>
                                          <option value=${id_lab3}>${lab3}</option>`)
                $("#tempo").append(`<option value=${dado.dados.tempo}>${dado.dados.tempo}</option>
                                    <option value=${tempo2}>${tempo2}</option>
                                    <option value=${tempo3}>${tempo3}</option>
                                    <option value=${tempo4}>${tempo4}</option>`)
                $("#descricao").val(dado.dados.descricao)
                $("#data").val(data)
                $("#hora").val(hora)
            }
        })
    })
})