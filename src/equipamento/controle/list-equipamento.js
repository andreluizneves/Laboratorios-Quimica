$(document).ready(function() {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/list-equipamento.php',
        async: true,
        success: function(dados) {
            if (dados.status == 'ok') {
                for (const dado of dados.dados) {

                    $('.cards-equipamentos').append(`
                    <div class="col-12 col-md-3 col-sm-12 col-lg-2">
                        <div class="card mb-4 shadow-sm">
                            <h2 class="text-center">
                                ${dado.nome}
                            </h2>
                            <img class="card-img-top mt-4" height="150px" src="${dado.foto}">
                            <div class="card-body">
                                <p class="card-text font-weight-bold">
                                    Número de Patrimônio: ${dado.numero_patrimonio}
                                    Descricao <br>
                                </p>
                                <p>
                                    ${dado.descricao}
                                </p>
                            </div>
                        </div>
                        </div>
                    </div>

                    `)
                }
            } else {
                $('.cards-equipamentos').append(`
           
                Nada encontrado nos registros

            `)
            }

        }
    });

})