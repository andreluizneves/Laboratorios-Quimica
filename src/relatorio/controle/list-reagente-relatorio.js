$(document).ready(function() {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/list-reagente-relatorio.php',
        async: true,
        success: function(dados) {
            if (dados.status == 'ok') {
                for (const dado of dados.dados) {

                    $('.reagentes').append(`
                            <div class="col-12 col-md-6 col-sm-6 col-lg-3 text-dark">
                                <div class="card mb-4 item-reagente" enviado="false" id="${dado.id_reagente}" name="${dado.nome}" style="cursor:pointer;" selecionado="false">
                                    <h4 class="text-center mb-2 mt-2 font-weight-bold nome">
                                        ${dado.nome}
                                    </h4>
                                    <p class="text-center">
                                        <img class="card-img-top img" height="200px" src="../../reagente/${dado.foto.substring(3)}">
                                    </p>
                                    <div class="card-body">
                                        <p class="card-text font-weight-bold num_pa">
                                            Quantidade:
                                        </p>
                                        <p class="card-text">
                                            ${dado.quantidade}${dado.medida}
                                        </p>
                                    </div>
                                    <form id="usado_reagente_${dado.id_reagente}" class="form-reagente">
                                        Usei: &nbsp; <input class='quantidade' type="number" ativo='true' style="width:80px" name='quantidade'>
                                        <input value="${dado.medida}" disabled style="width:40px"> <input class='id d-none' name='id_reagente' value="${dado.id_reagente}">
                                    </form>
                                </div>
                            </div>
                    `)
                }
                $('.reagentes').append(`<script>   
                                            $(document).ready(function() {
                                                $('.form-reagente').hide()
                                            })
                                        </script>`)
            } else {
                $('.reagentes').append(`<div class="col-12 col-col-12 col-sm-12 col-lg-12 mt-4">
                                            <h2 class="text-center">
                                                Nada encontrado nos registros
                                            </h2>
                                        </div>`)
            }
        }
    });
    $('.btn-salvar-reagente').click(function() {
        $('#modal-reagente').modal('hide')
    })

})