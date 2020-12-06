$(document).ready(function() {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/list-vidraria-quebrada.php',
        success: function(dados) {
            if (dados.status == 'ok') {

                for (const dado of dados.dados) {
                    if (dado.titulo == null && dado.data_hora == null) {
                        dado.data_hora = "<br> Não quebrou em aula"
                        dado.titulo = "<br> Não quebrou em aula"
                    }
                    $('.cards-vidrarias-quebradas').append(`
                            <div class="col-12 col-md-3 col-sm-12 col-lg-2">
                                <div class="card mb-4 shadow-sm">
                                    <h2 class="text-center">
                                        ${dado.nome}
                                    </h2>
                                    <img class="card-img-top mt-4" height="150px" src="${dado.foto}">
                                    <div class="card-body">
                                        <p class="card-text">
                                            Data quebrada: ${dado.data_hora}
                                        </p>
                                        <p class="card-text font-weight-bold">
                                            Aula em que ocorreu: ${dado.titulo}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        `)


                }
            } else {
                $('.cards-vidrarias-quebradas').append(`Nada encontrado nos registros`)
            }

        }
    });
    $('#pesquisa').keyup(function() {

        var dados = $('#caixa-pesquisa').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/filtro-vidraria-quebrada.php',
            async: true,
            data: dados,
            success: function(dados) {

                if (dados.status == 'ok') {

                    $('.cards-vidrarias-quebradas').empty()
                    for (const dado of dados.dados) {
                        if (dado.titulo == null && dado.data_hora == null) {
                            dado.data_hora = "<br> Não quebrou em aula"
                            dado.titulo = "<br> Não quebrou em aula"
                        }
                        $('.cards-vidrarias-quebradas').append(`
                                <div class="col-12 col-md-3 col-sm-12 col-lg-2">
                                    <div class="card mb-4 shadow-sm">
                                        <h2 class="text-center">
                                            ${dado.nome}
                                        </h2>
                                        <img class="card-img-top mt-4" height="150px" src="${dado.foto}">
                                        <div class="card-body">
                                            <p class="card-text">
                                                Data quebrada: ${dado.data_hora}
                                            </p>
                                            <p class="card-text font-weight-bold">
                                                Aula em que ocorreu: ${dado.titulo}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            `)
                    }
                } else {
                    $('.cards-vidrarias-quebradas').append(`Nada encontrado nos registros`)
                }
            }
        });
    })
})