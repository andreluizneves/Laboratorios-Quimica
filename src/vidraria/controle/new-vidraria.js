$(document).ready(function() {
    $('.btn-new-vidraria').click(function() {
        $('.cards-vidrarias').empty()
        $('.cards-vidrarias-quebradas').empty()
        $('.container-fluid').empty()
        $('.container-fluid').load('form-vidraria.html')
    })
    $('.btn-view-vidraria').click(function() {
        $('.cards-vidrarias').empty()
        $('.cards-vidrarias-quebradas').empty()
        $('.container-fluid').empty()
        $('.container-fluid').load('list-vidraria.html')
    })
    $('.btn-view-vidraria-quebrada').click(function() {
        $('.cards-vidrarias').empty()
        $('.cards-vidrarias-quebradas').empty()
        $('.container-fluid').empty()
        $('.container-fluid').load('list-vidraria-quebrada.html')
    })
    $('.btn-new-vidraria-quebrada').click(function() {
        $('.cards-vidrarias').empty()
        $('.cards-vidrarias-quebradas').empty()
        $('.container-fluid').empty()
        $('.container-fluid').load('form-vidraria-quebrada.html')
    })

    $('.btn-send').click(function(e) {

        e.preventDefault()

        var dados = $('#form-vidraria').serialize();

        $.ajax({
            type: 'POST',
            dataType: 'json',
            url: '../modelo/new-vidraria.php',
            async: true,
            data: dados,
            success: function(dados) {
                Swal.fire({
                    icon: dados.icone,
                    html: '<h2 style="color:white;">' + dados.msg + '</h2>',
                    background: 'rgb(39, 39, 61)',
                })
                if (dados.icone == 'success') {
                    $('.input').val('')
                }
            }
        });
    })
})