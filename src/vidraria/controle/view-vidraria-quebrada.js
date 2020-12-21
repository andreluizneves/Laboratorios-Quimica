$(document).ready(function() {

    $('.vidrarias').on('click', 'button.btn-view-vidraria-quebrada', function(e) {

        $('#modal-vidraria-quebrada').modal('show')
        $('#relatorio').empty()

        let vidrarias_quebrada = `id_vidraria_quebrada=${$(this).attr('id')}`

        $.ajax({
            type: 'POST',
            data: vidrarias_quebrada,
            async: true,
            dataType: 'json',
            url: '../modelo/view-vidraria-quebrada.php',
            success: function(dados) {
                if (dados.dados.titulo == null) {
                    dados.dados.id_relatorio = ""
                    dados.dados.titulo = 'Não quebrado em aula'.toUpperCase()
                }
                $("#id_vidraria_quebrada").val(dados.dados.id_vidraria_quebrada)
                $(".modal-title").empty()
                $(".modal-title").text(`Visualizando Vidraria Quebrada: ${dados.dados.nome}`)
                $('.btn-fechar').removeClass('d-none')
                $('.btn-cancelar').addClass('d-none')
                $('.btn-update-quebrada').addClass('d-none')
                $(".lare").text()
                $(".foto-q").addClass('d-none')
                $(".label-foto").addClass('d-none')
                $('#foto2').attr('src', dados.dados.foto)
                $('#quantidade2').val(dados.dados.quantidade + ' unidades')
                $('#quantidade2').attr('readonly', true)
                $('#quantidade2').attr('disabled', true)
                $('#relatorio').attr('readonly', true)
                $('#relatorio').attr('disabled', true)
                $('#relatorio').append(`<option value = "${dados.dados.id_relatorio}">${dados.dados.titulo}</option>`)
            }
        })
    })
})