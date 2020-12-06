$(document).ready(function() {

    $.ajax({
        dataType: 'json',
        url: '../modelo/list-reagente-relatorio.php',
        success: function(dados) {
            if (dados.status == 'ok') {
                for (const dado of dados.dados) {

                    $('.reagente').append(`
                    <div class="col-12 col-md-3 col-sm-12 col-lg-2 item-reagente">
                        <div class="card mb-4 shadow-sm item" name="${dado.nome}">
                            <h2 class="text-center">
                                ${dado.nome}
                            </h2>
                            <img class="card-img-top mt-4" height="150px" src="${dado.foto}">
                            <div class="card-body">
                                <p class="card-text">
                                    Quantidade: ${dado.quantidade}${dado.medida}
                                </p>
                            </div>
                            <div class="row quantidade invisible" name="${dado.nome}q">
                                <div class="col-12"
                                    <form id="reagente_utilizado">
                                        Usei:<input name='${dado.nome}' style="width: 90px;" value=''><input style="width: 40px;" value='${dado.medida}' disabled>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    `)
                }
                $('.reagente').append(`
                <script>

                    $('.item').click(function() {
                        $(this).css('border', 'blue 4px solid')
                        var selecionado_reagente = "div[name='" + $(this).attr('name') + "q" + "']"
                        $(selecionado_reagente).removeClass('invisible')
                    })
                           
                    $('.item').dblclick(function() {
                        $(this).removeAttr('style')
                        var selecionado_reagente = "div[name='" + $(this).attr('name') + "q" + "']"
                        $(selecionado_reagente).addClass('invisible')
                    })
                           
                </script>`)
            } else {
                $('.reagente').append(`
           
                    Nada encontrado nos registros

                `)
            }
        }
    });
    $('.btn-salvar-reag').click(function() {
        $('#modal-reag').modal('hide')
    })
})