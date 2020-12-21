$(document).ready(function() {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/list-vidraria-quebrada.php',
        success: function(dados) {
            if (dados.status == 'ok') {
                if (dados.user == 'professor(a)') {
                    $('.vidrarias').empty()
                    for (const dado of dados.dados) {
                        if (dado.titulo == null) {
                            dado.titulo = 'Não quebrado em aula'.toUpperCase()
                        }
                        $('.vidrarias').append(`
                            <div class="col-12 col-md-6 col-sm-6 col-lg-3 text-dark">
                                <div class="card mb-4 item">
                                    <h4 class="text-center mb-2 mt-2 font-weight-bold nome">
                                        ${dado.nome}
                                    </h4>
                                    <p class="text-center">
                                        <img class="card-img-top img" height="200px" src="${dado.foto}">
                                    </p>
                                    <div class="card-body">
                                        <p class="card-text font-weight-bold num_pa">
                                            Aula em que foi quebrada:
                                        </p>
                                        <p class="card-text">
                                            ${dado.titulo}
                                        </p>
                                        <div class="botoes">
                                            <button id="${dado.id_vidraria_quebrada}" idr="${dado.id_relatorio}" title="Editar" class='btn btn-warning btn-edit-vidraria-quebrada'><i class="fas fa-pen"></i></button>
                                            <button id="${dado.id_vidraria_quebrada}" idr="${dado.id_relatorio}" title="Visualizar" class='btn btn-primary btn-view-vidraria-quebrada'><i class="fas fa-eye"></i></button>
                                            <button id="${dado.id_vidraria_quebrada}" idr="${dado.id_relatorio}" title="Deletar" class='btn btn-danger btn-delete-vidraria-quebrada'><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    }
                } else {
                    $('.vidrarias').empty()
                    for (const dado of dados.dados) {
                        if (dado.titulo == null) {
                            dado.titulo = 'Não quebrado em aula'.toUpperCase()
                        }
                        $('.vidrarias').append(`
                            <div class="col-12 col-md-6 col-sm-6 col-lg-3 text-dark">
                                <div class="card mb-4 item">
                                    <h4 class="text-center mb-2 mt-2 font-weight-bold nome">
                                        ${dado.nome}
                                    </h4>
                                    <p class="text-center">
                                        <img class="card-img-top img" height="200px" src="${dado.foto}">
                                    </p>
                                    <div class="card-body">
                                        <p class="card-text font-weight-bold num_pa">
                                            Aula em que foi quebrada:
                                        </p>
                                        <p class="card-text">
                                            ${dado.titulo}
                                        </p>
                                        <div class="botoes">
                                            <button id="${dado.id_vidraria_quebrada}" idr="${dado.id_relatorio}" title="Visualizar" class='btn btn-primary btn-view-vidraria-quebrada'><i class="fas fa-eye"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    }
                }
            } else {
                $('.vidrarias').append(`<div class="col-12 col-col-12 col-sm-12 col-lg-12">
                                            <h2 class="text-center">
                                                Nada encontrado nos registros
                                            </h2>
                                        </div>`)
            }
        }
    });

    $('#pesquisa-quebrada').keyup(function() {
        $('.col-form').removeClass('d-none')
        $('.col-list').addClass('d-none')

        var dados = $('#caixa-pesquisa-quebrada').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/filtro-vq.php',
            async: true,
            data: dados,
            success: function(dados) {
                if (dados.dados != null) {
                    if (dados.user == 'professor(a)') {
                        $('.vidrarias').empty()
                        for (const dado of dados.dados) {
                            $('.vidrarias').append(`
                                <div class="col-12 col-md-6 col-sm-6 col-lg-3 text-dark">
                                    <div class="card mb-4 item">
                                        <h4 class="text-center mb-2 mt-2 font-weight-bold nome">
                                            ${dado.nome}
                                        </h4>
                                        <p class="text-center">
                                            <img class="card-img-top img" height="200px" src="${dado.foto}">
                                        </p>
                                        <div class="card-body">
                                            <p class="card-text font-weight-bold num_pa">
                                                Aula em que foi quebrada:
                                            </p>
                                            <p class="card-text">
                                                ${dado.titulo}
                                            </p>
                                            <div class="botoes">
                                                <button id="${dado.id_vidraria_quebrada}" idr="${dado.id_relatorio}" title="Editar" class='btn btn-warning btn-edit-vidraria-quebrada'><i class="fas fa-pen"></i></button>
                                                <button id="${dado.id_vidraria_quebrada}" idr="${dado.id_relatorio}" title="Visualizar" class='btn btn-primary btn-view-vidraria-quebrada'><i class="fas fa-eye"></i></button>
                                                <button id="${dado.id_vidraria_quebrada}" idr="${dado.id_relatorio}" title="Deletar" class='btn btn-danger btn-delete-vidraria-quebrada'><i class="fas fa-trash"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `)
                        }
                    } else {
                        $('.vidrarias').empty()
                        for (const dado of dados.dados) {
                            $('.vidrarias').append(`
                                <div class="col-12 col-md-6 col-sm-6 col-lg-3 text-dark">
                                    <div class="card mb-4 item">
                                        <h4 class="text-center mb-2 mt-2 font-weight-bold nome">
                                            ${dado.nome}
                                        </h4>
                                        <p class="text-center">
                                            <img class="card-img-top img" height="200px" src="${dado.foto}">
                                        </p>
                                        <div class="card-body">
                                            <p class="card-text font-weight-bold num_pa">
                                                Aula em que foi quebrada:
                                            </p>
                                            <p class="card-text">
                                                ${dado.titulo}
                                            </p>
                                            <div class="botoes">
                                                <button id="${dado.id_vidraria_quebrada}" idr="${dado.id_relatorio}" title="Visualizar" class='btn btn-primary btn-view-vidraria-quebrada'><i class="fas fa-eye"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `)
                        }
                    }
                } else {
                    $('.vidrarias').empty()
                    $('.vidrarias').append(`<div class="col-12 col-col-12 col-sm-12 col-lg-12">
                                                <h2 class="text-center">
                                                    Nada encontrado nos registros
                                                </h2>
                                            </div>`)
                }
            }
        });
    })
})