$(document).ready(function() {
    $('.vidrarias').on('click', 'div.item-vidraria', function() {
        if ($(this).attr('selecionado') == 'false' && $(".aviso-vidraria").attr('enviado') != 'true') {

            $(this).attr('selecionado', true)
            var item = $(this)

            let id_vidraria = `id_vidraria=${$(this).attr('id')}`

            $.ajax({
                type: 'POST',
                data: id_vidraria,
                async: true,
                dataType: 'json',
                url: '../modelo/add-itens-vidraria.php',
                success: function(envio) {
                    $(item).attr('style', 'border: green 4px solid; cursor:pointer; box-shadow:0px 0px 35px 8px rgba(127,255,0,0.92)')
                }
            })

        } else if ($(".aviso-vidraria").attr('enviado') == 'true') {
            Swal.fire({
                icon: 'warning',
                html: '<h2 style="color:white;">Vidrarias ja relatados</h2>',
                background: 'rgb(39, 39, 61)',
                textConfirmButton: 'OK'
            })
        } else if ($(this).attr('selecionado') == 'true' && $(".aviso-vidraria").attr('enviado') != 'true') {

            $(this).attr('style', 'cursor:pointer;')
            $(this).attr('selecionado', false)
            var item = $(this)
            let id_vidraria_remove = `id_vidraria_remove=${$(this).attr('id')}`

            $.ajax({
                type: 'POST',
                data: id_vidraria_remove,
                async: true,
                dataType: 'json',
                url: '../modelo/remove-itens-vidraria.php',
                success: function(envio) {
                    if (envio.selecionado == 'n') {
                        $(item).attr('style', 'cursor:pointer;')
                    }
                }
            })
        }
    })
    $(".btn-salvar-vidraria").click(function() {
        $("#modal-vidraria").modal('hide')
        Swal.fire({
            icon: 'success',
            html: '<h2 style="color:white;"> Vidraria(s) usado(s) cadastrado(s) com sucesso</h2>',
            background: 'rgb(39, 39, 61)',
            textConfirmButton: 'OK'
        })
        $(".btn-salvar-vidraria").addClass('d-none')
        $(".aviso-vidraria").text('Vidrarias usadas já cadastradas')
        $(".aviso-vidraria").attr('enviado', true)
        $(".item-vidraria[selecionado='true']").attr('enviado', true)
        $.ajax({
            type: 'POST',
            async: true,
            dataType: 'json',
            url: '../modelo/salvar-vidraria.php'
        })
    })
})