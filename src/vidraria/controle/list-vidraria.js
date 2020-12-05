$(document).ready(function() {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/list-vidraria.php',
        async: true,
        success: function(dados) {
            if (dados.status == 'ok') {
                for (const dado of dados.dados) {

                    $('.cards-vidrarias').append(`
                    <div class="col-12 col-md-3 col-sm-12 col-lg-2">
                        <div class="card mb-4 shadow-sm">
                            <h2 class="text-center">
                                ${dado.nome}
                            </h2>
                            <img class="card-img-top mt-4" height="150px" src="${dado.foto}">
                            <div class="card-body">
                                <p class="card-text">
                                    Quantidade: ${dado.descricao}
                                </p>
                                <p class="card-text font-weight-bold">
                                    Quantidade: ${dado.quantidade}
                                </p>
                            </div>
                        </div>
                    </div>

                    `)
                }
            } else {
                $('.cards-vidrarias').append(`
           
                Nada encontrado nos registros

            `)
            }

        }
    });

})