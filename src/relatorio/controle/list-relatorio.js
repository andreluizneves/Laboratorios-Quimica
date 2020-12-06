$(document).ready(function() {

    $.ajax({
        dataType: 'json',
        url: '../modelo/list-relatorio.php',
        success: function(dados) {
            if (dados.status == 'ok') {
                for (const dado of dados.dados) {
                    $('.cards-relatorios').append(`
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
                                    </div>
                                    <div class="mb-2 mt-2">
                                        <img style="width: 16px;" src="../../../recursos/img/icons/icon1.png" alt=""> &nbsp;
                                        <img style="width: 16px;" src="../../../recursos/img/icons/icon1.png" alt=""> &nbsp;
                                        <img style="width: 16px;" src="../../../recursos/img/icons/icon1.png" alt=""> &nbsp;
                                        <img style="width: 16px;" src="../../../recursos/img/icons/icon1.png" alt="">
                                    </div>
                                    <div id="botoes">
                                        <button class='btn btn-warning btn-edit-relatorio'><i class="fas fa-pen"></i></button>
                                        <button class='btn btn-primary btn-view-relatorio'><i class="fas fa-eye"></i></button>
                                        <button class='btn btn-danger btn-delete'><i class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <br>
                `)
                }
            } else {
                $('.cards-relatorios').append(`Nada encontrado nos registros`)
            }
        }
    })
})