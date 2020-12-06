$(document).ready(function() {

    $('.btn-voltar').click(function() {
        $(location).attr('href', 'index.php')
    })

    $('.btn-recuperar-senha').click(function() {
        Swal.fire({
            icon: 'success',
            html: '<h1 style="color:white;">Email de recuperação de senha enviado com êxito</h1>',
            background: 'rgb(39, 39, 61)',
        })
        $('.input').val('')
    })
})