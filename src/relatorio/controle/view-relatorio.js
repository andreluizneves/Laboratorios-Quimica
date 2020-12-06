$(document).ready(function() {
    $('.btn-list-relatorio').click(function(e) {
        $('.container').empty()
        $('.container').load('list-relatorio.html')
    })
    $(".cards-relatorios").on('click', 'button.btn-view-relatorio', function(e) {
        $('.modal-body').load('list-itens.html', function() {
            $()
            $('#modal-relatorio').modal('show')
        })
    })
})