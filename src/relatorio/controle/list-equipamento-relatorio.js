$(document).ready(function() {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/list-equipamento-relatorio.php',
        async: true,
        success: function(dados) {
            if (dados.status == 'ok') {
                for (const dado of dados.dados) {

                    $('.equipamento').append(`
                        <div class="col-12 col-md-3 col-sm-12 col-lg-2 item-equipamento" style="padding:8px;">
                            <div class="card mb-4 shadow-sm item" name="${dado.nome}">
                                <h2 class="text-center">
                                    ${dado.nome}
                                </h2>
                                <img class="card-img-top mt-4" height="150px" src="${dado.foto}">
                                <div class="card-body">
                                    <p class="card-text font-weight-bold">
                                        Número de Patrimônio: ${dado.numero_patrimonio}
                                    </p>
                                    <p class="card-text font-weight-bold">
                                        Descrição:
                                    </p>
                                    <p>
                                        ${dado.descricao}
                                    </p>
                                </div>
                            </div>
                            <form id="equipamento_utilizadas">
                                <input name='${dado.nome}' style="display:block" value=''>
                            </form>
                        </div>
                    `)
                }

                $('.equipamento').append(`
                <script>

                    $('.item').click(function() {
                        $(this).css('border', 'blue 4px solid')
                        var selecionado_ide = "input[name='" + $(this).attr('name') + "']"
                        $(selecionado_ide).val('selecionado')
                    })
                           
                    $('.item').dblclick(function() {
                        $(this).removeAttr('style')
                        var selecionado_ide = "input[name='" + $(this).attr('name') + "']"
                        $(selecionado_ide).val('')
                    })
                           
                </script>`)
            } else {
                $('.equipamento').append(`Nada encontrado nos registros`)
            }
        }
    });
    $('.btn-salvar-equip').click(function() {
        $('#modal-equip').modal('hide')
    })
})