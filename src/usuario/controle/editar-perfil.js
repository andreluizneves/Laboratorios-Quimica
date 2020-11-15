window.onload = function() {
    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/dados.php',
        async: true,
        success: function(dados) {
            $('.nome').val(`${dados.nome}`)
            $('.email').val(`${dados.email}`)
            $('.ra').val(`${dados.ra}`)
        }
    });
}
$('.btn-permitir-edicao').click(function() {
    $(".ra, .nome, .email").prop('disabled', function() {
        return !$(this).prop('disabled');
    });
})
$('.btn-editar-perfil').click(function(e) {
    e.preventDefault()

    var dados = $('#form-edit').serialize();

    $.ajax({
        type: 'POST',
        dataType: 'json',
        url: '../modelo/editar-perfil.php',
        data: dados,
        async: true,
        success: function(dados) {
            $('.nome').val(`${dados.nome}`)
            $('.email').val(`${dados.email}`)
            $('.ra').val(`${dados.ra}`)
        }
    });
})