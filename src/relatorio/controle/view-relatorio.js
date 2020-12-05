$(document).ready(function() {
    $('.btn-view-relatorio').click(function() {
        $('.container-fluid').empty()
        $('.container-fluid').load('list-relatorio.html')
    })
})