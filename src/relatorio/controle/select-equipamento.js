$(document).ready(function() {
    $('.equipamentos').on('click', 'div.item-equipamento', function() {
        if ($(this).attr('selecionado') == 'false' && $(".aviso-equipamento").attr('enviado') != 'true') {

            $(this).attr('selecionado', true)
            var item = $(this)

            let id_equipamento = `id_equipamento=${$(this).attr('id')}`

            $.ajax({
                type: 'POST',
                data: id_equipamento,
                async: true,
                dataType: 'json',
                url: '../modelo/add-itens-equipamento.php',
                success: function(envio) {
                    $(item).attr('style', 'border: green 4px solid; cursor:pointer; box-shadow:0px 0px 35px 8px rgba(127,255,0,0.92);')
                }
            })

        } else if ($(".aviso-equipamento").attr('enviado') == 'true') {
            Swal.fire({
                icon: 'warning',
                html: '<h2 style="color:white;">Equipamentos ja relatados</h2>',
                background: 'rgb(39, 39, 61)',
                textConfirmButton: 'OK'
            })
        } else if ($(this).attr('selecionado') == 'true' && $(".aviso-equipamento").attr('enviado') != 'true') {

            $(this).attr('style', 'cursor:pointer;')
            $(this).attr('selecionado', false)
            var item = $(this)
            let id_equipamento_remove = `id_equipamento_remove=${$(this).attr('id')}`

            $.ajax({
                type: 'POST',
                data: id_equipamento_remove,
                async: true,
                dataType: 'json',
                url: '../modelo/remove-itens-equipamento.php',
                success: function(envio) {
                    if (envio.selecionado == 'n') {
                        $(item).attr('style', 'cursor:pointer;')
                    }
                }
            })
        }
    })
    $(".btn-salvar-equipamento").click(function() {
        $("#modal-equipamento").modal('hide')
        Swal.fire({
            icon: 'success',
            html: '<h2 style="color:white;"> Equipamento(s) usado(s) cadastrado(s) com sucesso</h2>',
            background: 'rgb(39, 39, 61)',
            textConfirmButton: 'OK'
        })
        $(".aviso-equipamento").text('Equipamentos usados já cadastrado')
        $(".aviso-equipamento").attr('enviado', true)
        $(".btn-salvar-equipamento").addClass('d-none')
        $(".item-equipamento[selecionado='true']").attr('enviado', true)
        $.ajax({
            type: 'POST',
            async: true,
            dataType: 'json',
            url: '../modelo/salvar-equipamento.php'
        })
    })
})