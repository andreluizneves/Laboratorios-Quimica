$(document).ready(function() {
    $('.reagentes').on('click', 'div.item-reagente', function() {
        if ($(this).attr('selecionado') == "false" && $(".aviso-reagente").attr('enviado') != 'true') {

            $(this).attr('selecionado', true)
            var item = $(this).attr('id')
            $(`#usado_reagente_${item}`).show(200)
            $(this).attr('style', 'border: green 4px solid; cursor:pointer; box-shadow:0px 0px 35px 8px rgba(127,255,0,0.92)')

            if ($(this).attr('enviado') == 'false' && $(this).attr('selecionado') == 'true') {
                $(".btn-salvar-reagente").click(function() {

                    var dados = $(`#usado_reagente_${item}`).serialize()

                    $.ajax({
                        type: 'POST',
                        data: dados,
                        async: true,
                        dataType: 'json',
                        url: '../modelo/add-uso-reagente.php',
                        success: function(envio) {
                            $(this).attr('enviado', true)
                            $(".quantidade").attr('disabled', true)
                            $('.item-reagente').attr('enviado', true)
                            $(".item-reagente").attr('enviado', true)
                            $(".btn-salvar-reagente").addClass('d-none')
                            $(".aviso-reagente").attr('enviado', true)
                            $(".aviso-reagente").text('Quantidade de cada item já cadastrado')
                            Swal.fire({
                                icon: 'success',
                                html: '<h2 style="color:white;"> Reagente cadastrado com sucesso</h2>',
                                background: 'rgb(39, 39, 61)',
                                textConfirmButton: 'OK'
                            })
                        }
                    })
                })
            }
        } else if ($(".aviso-reagente").attr('enviado') == 'true') {
            Swal.fire({
                icon: 'warning',
                html: '<h2 style="color:white;">Quantidade de Reagente já relatados</h2>',
                background: 'rgb(39, 39, 61)',
                textConfirmButton: 'OK'
            })
        }
    })
    $('.reagentes').on('dblclick', 'div.item-reagente', function() {
        if ($(this).attr('enviado') != 'true') {
            $(this).attr('style', 'cursor:pointer;')
            $(this).attr('selecionado', false)
            var item = $(this).attr('id')
            $(`#usado_reagente_${item}`).hide(200)

            var dados = $(`#usado_reagente_${item}`).serialize()

            $.ajax({
                type: 'POST',
                data: dados,
                async: true,
                dataType: 'json',
                url: '../modelo/remove-itens-reagente.php',
                success: function(envio) {
                    if (envio.selecionado == 'n') {
                        $(this).attr('style', 'cursor:pointer;')
                    }
                }
            })
        }
    })
})