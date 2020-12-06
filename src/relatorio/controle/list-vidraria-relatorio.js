$(document).ready(function() {

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/list-vidraria-relatorio.php',
        async: true,
        success: function(dados) {
            if (dados.status == 'ok') {
                for (const dado of dados.dados) {

                    $('.vidraria').append(`
                    
                    <div class="col-12 col-md-3 col-sm-12 col-lg-2 item-vidraria">
                        <div class="card mb-4 shadow-sm item" name="${dado.nome}">
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
                        <form id="vidraria_utilizadas">
                            <input name='${dado.nome}v' style="display:none" value=''>
                        </form>
                    </div>
                    `)
                }

                $('.vidraria').append(`
                <script>

                    $('.item').click(function() {
                        $(this).css('border', 'blue 4px solid')
                        var selecionado_id3 = "input[name='" + $(this).attr('name') + "v" + "']"
                        $(selecionado_id3).val('selecionado')
                    })
                           
                    $('.item').dblclick(function() {
                        $(this).removeAttr('style')
                        var selecionado_id3 = "input[name='" + $(this).attr('name') + "v" + "']"
                        $(selecionado_id3).val('')
                    })

                    $('btn-salvar-vidr').click(function(){
                        alert(selecionados)
                    })
                    $('btn-vidraria-quebrada').click(function(){
                        
                    })
                           
                </script>`)
            } else {
                $('.vidraria').append(`
           
                    Nada encontrado nos registros

                `)
            }

        }
    });
    $('.btn-salvar-vidraria').click(function() {
        $('#modal-vidr').modal('hide')
    })


})