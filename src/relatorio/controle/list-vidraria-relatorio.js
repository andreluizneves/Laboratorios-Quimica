$(document).ready(function() {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/list-vidraria-relatorio.php',
        async: true,
        success: function(dados) {
            if (dados.status == 'ok') {
                for (const dado of dados.dados) {

                    $('.vidrarias').append(`
                    <div class="col-12 col-md-3 col-sm-6 col-lg-3 text-dark">
                        <div class="card mb-4 item-vidraria" enviado="false" id="${dado.id_vidraria}" nome="${dado.nome}" style="cursor:pointer;" selecionado="false">
                            <h4 class="text-center mb-2 mt-2 font-weight-bold nome">
                                ${dado.nome}
                            </h4>
                            <p class="text-center">
                                <img class="card-img-top img" height="200px" src="../../vidraria/${dado.foto.substring(3)}">
                            </p>
                            <div class="card-body">
                                <p class="card-text font-weight-bold num_pa">
                                    Quantidade:
                                </p>
                                <p class="card-text">
                                    ${dado.quantidade} unidades
                                </p>
                            </div>
                        </div>
                    </div>
                    `)
                }
            } else {
                $('.vidrarias').append(`<div class="col-12 col-col-12 col-sm-12 col-lg-12 mt-4">
                                            <h2 class="text-center">
                                                Nada encontrado nos registros
                                            </h2>
                                        </div>`)
            }
        }
    });
    $('.btn-salvar-vidraria').click(function() {
        $('#modal-vidraria').modal('hide')
    })
})