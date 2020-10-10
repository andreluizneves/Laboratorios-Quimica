$(document).ready(function() {
    $('.btn-rec_senha').click(function() {
        $('.btn-rec_senha').click(function() {
            Swal.fire({
                icon: 'success',
                html: '<h1 style="color:white;">Email de recuperação de senha enviado com êxito</h1>',
                background: 'rgb(39, 39, 61)',
            })
            $('.input').val('')
        })
    })
    $('.btn-voltar').click(function() {
        window.open('../../../index.html')
    })
})