$(document).ready(function() {

    $.ajax({
        dataType: 'json',
        url: '../modelo/list-relatorio.php',
        success: function(dados) {
            if (dados.status == 'ok') {
                if (dados.user == 'professor(a)') {
                    for (const dado of dados.dados) {
                        $('.relatorios').append(`
                            <div class="col-12 col-md-12 col-sm-6 col-lg-12 mb-4">
                                <div class="card">
                                    <div class="card-header font-weight-bold">
                                        Relatório ${dado.titulo}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 text-left">
                                                <div class="font-weight-bold">
                                                    Professor(a): ${dado.nome_professor}
                                                </div>
                                                <br>
                                                <div class="mt-3">
                                                    Laboratório ${dado.laboratorio}
                                                </div>
                                            </div>
                                            <div class="col-6 text-right">
                                                <div class="font-weight-bold">
                                                <i class="fas fa-calendar-alt"></i>
                                                ${dado.data_hora}
                                                <i class="fas fa-clock"></i>
                                                </div><!--
                                                <div class="mb-2 mt-2">
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon-equipamento.jpg" alt=""> &nbsp;
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon1.png" alt=""> &nbsp;
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon-vidraria.png" alt=""> &nbsp;
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon-vidr-qbr.png" alt="">
                                                </div>-->
                                                <div id="botoes" class="mt-4">
                                                    <button id="${dado.id_relatorio}" class='btn btn-warning btn-edit-relatorio'><i class="fas fa-pen"></i></button>
                                                    <button id="${dado.id_relatorio}" class='btn btn-primary btn-view-relatorio'><i class="fas fa-eye"></i></button>
                                                    <button id="${dado.id_relatorio}" class='btn btn-danger btn-delete-relatorio'><i class="fas fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    }
                } else {
                    for (const dado of dados.dados) {
                        $('.relatorios').append(`
                            <div class="col-12 col-md-12 col-sm-6 col-lg-12 mb-4">
                                <div class="card">
                                    <div class="card-header font-weight-bold">
                                        Relatório ${dado.titulo}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 text-left">
                                                <div class="font-weight-bold">
                                                    Professor(a): ${dado.nome_professor}
                                                </div>
                                                <br>
                                                <div class="mt-3">
                                                    Laboratório ${dado.laboratorio}
                                                </div>
                                            </div>
                                            <div class="col-6 text-right">
                                                <div class="font-weight-bold">
                                                <i class="fas fa-calendar-alt"></i>
                                                ${dado.data_hora}
                                                <i class="fas fa-clock"></i>
                                                </div><!--
                                                <div class="mb-2 mt-2">
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon-equipamento.jpg" alt=""> &nbsp;
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon1.png" alt=""> &nbsp;
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon-vidraria.png" alt=""> &nbsp;
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon-vidr-qbr.png" alt="">
                                                </div>-->
                                                <div id="botoes" class="mt-4">
                                                    <button id="${dado.id_relatorio}" class='btn btn-primary btn-view-relatorio'><i class="fas fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                    }
                }
            } else {
                $('.relatorios').append(`<div class="col-12 col-col-12 col-sm-12 col-lg-12">
                                                    <h2 class="text-center">
                                                        Nada encontrado nos registros
                                                    </h2>
                                                </div>`)
            }
        }
    })
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
                if (dados.status == 'ok') {
                    if (dados.user == 'professor(a)') {
                        $('.relatorios').empty()
                        for (const dado of dados.dados) {
                            $('.relatorios').append(`
                                <div class="col-12 col-md-12 col-sm-6 col-lg-12 mb-4">
                                <div class="card">
                                    <div class="card-header font-weight-bold">
                                        Relatório: ${dado.titulo}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 text-left">
                                                <div class="font-weight-bold">
                                                    Professor(a): ${dado.nome_professor}
                                                </div>
                                                <br>
                                                <div class="mt-3">
                                                    Laboratório ${dado.laboratorio}
                                                </div>
                                            </div>
                                            <div class="col-6 text-right">
                                                <div class="font-weight-bold">
                                                <i class="fas fa-calendar-alt"></i>
                                                    ${dado.data_hora}
                                                <i class="fas fa-clock"></i>
                                                </div><!--
                                                <div class="mb-2 mt-2">
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon-equipamento.jpg" alt=""> &nbsp;
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon1.png" alt=""> &nbsp;
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon-vidraria.png" alt=""> &nbsp;
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon-vidr-qbr.png" alt="">
                                                </div>-->
                                                <div id="botoes" class="mt-4">
                                                    <button id="${dado.id_relatorio}" class='btn btn-warning btn-edit-relatorio'><i class="fas fa-pen"></i></button>
                                                    <button id="${dado.id_relatorio}" class='btn btn-primary btn-view-relatorio'><i class="fas fa-eye"></i></button>
                                                    <button id="${dado.id_relatorio}" class='btn btn-danger btn-delete-relatorio'><i class="fas fa-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                        }
                    } else {
                        $('.relatorios').empty()
                        for (const dado of dados.dados) {
                            $('.relatorios').append(`
                                <div class="col-12 col-md-12 col-sm-6 col-lg-12 mb-4">
                                <div class="card">
                                    <div class="card-header font-weight-bold">
                                        Relatório: ${dado.titulo}
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-6 text-left">
                                                <div class="font-weight-bold">
                                                    Professor(a): ${dado.nome_professor}
                                                </div>
                                                <br>
                                                <div class="mt-3">
                                                    Laboratório ${dado.laboratorio}
                                                </div>
                                            </div>
                                            <div class="col-6 text-right">
                                                <div class="font-weight-bold">
                                                <i class="fas fa-calendar-alt"></i>
                                                ${dado.data_hora}
                                                <i class="fas fa-clock"></i>
                                                </div><!--
                                                <div class="mb-2 mt-2">
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon-equipamento.jpg" alt=""> &nbsp;
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon1.png" alt=""> &nbsp;
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon-vidraria.png" alt=""> &nbsp;
                                                    <img style="width: 22px;" src="../../../recursos/img/icons/icon-vidr-qbr.png" alt="">
                                                </div>-->
                                                <div id="botoes" class="mt-4">
                                                    <button id="${dado.id_relatorio}" class='btn btn-primary btn-view-relatorio'><i class="fas fa-eye"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `)
                        }
                    }
                } else {
                    $('.relatorios').empty()
                    $('.relatorios').append(`<div class="col-12 col-col-12 col-sm-12 col-lg-12">
                                                    <h2 class="text-center">
                                                        Nada encontrado nos registros
                                                    </h2>
                                                </div>`)
                }
            }
        });
    })
})