$(document).ready(function() {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/list-equipamento.php',
        success: function(dados) {
            if (dados.status == 'ok') {
                if (dados.user == 'professor(a)') {
                    for (const dado of dados.dados) {

                        $('.equipamentos').append(`
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
                                        Número de Patrimônio:
                                    </p>
                                    <p class="card-text">
                                        ${dado.numero_patrimonio}
                                    </p>
                                    <div class="botoes">
                                        <button id="${dado.id_equipamento}" title="Editar" class='btn btn-warning btn-edit-equipamento'><i class="fas fa-pen"></i></button>
                                        <button id="${dado.id_equipamento}" title="Visualizar" class='btn btn-primary btn-view-equipamento'><i class="fas fa-eye"></i></button>
                                        <button id="${dado.id_equipamento}" title="Deletar" class='btn btn-danger btn-delete-equipamento'><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `)
                    }
                } else {
                    for (const dado of dados.dados) {

                        $('.equipamentos').append(`
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
                                        Número de Patrimônio:
                                    </p>
                                    <p class="card-text">
                                        ${dado.numero_patrimonio}
                                    </p>
                                    <div class="botoes">
                                        <button id="${dado.id_equipamento}" title="Visualizar" class='btn btn-primary btn-view-equipamento'><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `)
                    }
                }

            } else {
                $('.equipamentos').append(`<div class="col-12 col-col-12 col-sm-12 col-lg-12">
                                                <h2 class="text-center">
                                                    Nada encontrado nos registros
                                                </h2>
                                            </div>`)
            }
        }
    });

    $('#pesquisa').keyup(function() {
        $('.col-form').removeClass('d-none')
        $('.col-list').addClass('d-none')
        var dados = $('#caixa-pesquisa').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/filtro.php',
            async: true,
            data: dados,
            success: function(dados) {
                if (dados.dados != null) {
                    $('.equipamentos').empty()
                    if (dados.user == 'professor(a)') {
                        for (const dado of dados.dados) {

                            $('.equipamentos').append(`
                            <div class="col-12 col-md-3 col-sm-6 col-lg-3 text-dark">
                                <div class="card mb-4 item">
                                    <h4 class="text-center mb-2 mt-2 font-weight-bold nome">
                                        ${dado.nome}
                                    </h4>
                                    <p class="text-center">
                                        <img class="card-img-top img" height="200px" src="${dado.foto}">
                                    </p>
                                    <div class="card-body">
                                        <p class="card-text font-weight-bold num_pa">
                                            Número de Patrimônio:
                                        </p>
                                        <p class="card-text">
                                            ${dado.numero_patrimonio}
                                        </p>
                                        <div class="botoes">
                                            <button id="${dado.id_equipamento}" title="Editar" class='btn btn-warning btn-edit-equipamento'><i class="fas fa-pen"></i></button>
                                            <button id="${dado.id_equipamento}" title="Visualizar" class='btn btn-primary btn-view-equipamento'><i class="fas fa-eye"></i></button>
                                            <button id="${dado.id_equipamento}" title="Deletar" class='btn btn-danger btn-delete-equipamento'><i class="fas fa-trash"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                        }
                    } else {
                        for (const dado of dados.dados) {

                            $('.equipamentos').append(`
                            <div class="col-12 col-md-3 col-sm-6 col-lg-3 text-dark">
                                <div class="card mb-4 item">
                                    <h4 class="text-center mb-2 mt-2 font-weight-bold nome">
                                        ${dado.nome}
                                    </h4>
                                    <p class="text-center">
                                        <img class="card-img-top img" height="200px" src="${dado.foto}">
                                    </p>
                                    <div class="card-body">
                                        <p class="card-text font-weight-bold num_pa">
                                            Número de Patrimônio:
                                        </p>
                                        <p class="card-text">
                                            ${dado.numero_patrimonio}
                                        </p>
                                        <div class="botoes">

                                            <button id="${dado.id_equipamento}" title="Visualizar" class='btn btn-primary btn-view-equipamento'><i class="fas fa-eye"></i></button>
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                        }
                    }

                } else {
                    $('.equipamentos').empty()
                    $('.equipamentos').append(`<div class="col-12 col-col-12 col-sm-12 col-lg-12">
                                                    <h2 class="text-center">
                                                        Nada encontrado nos registros
                                                    </h2>
                                                </div>`)
                }
            }
        });
    })
})