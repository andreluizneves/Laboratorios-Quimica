$(document).ready(() => {
    $("#rm, #ra").mask("99999")
    $(".btn-cadastrar").click(() => {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "src/usuarios/cadastro",
            data: $("#form-cadastro").serialize(),
            success: (dados) => {
                var statusBtn = true;
                if (dados.icone == "success") {
                    statusBtn = false
                    $("input").val("")
                    setTimeout(() => {
                        $(location).attr("href", "menu")
                    }, 1150);
                }
                Swal.fire({
                    icon: dados.icone,
                    html: `<h2 style="color:white;">${dados.msg}</h2>`,
                    background: "rgb(39, 39, 61)",
                    showConfirmButton: statusBtn,
                    allowOutsideClick: false
                })
            }
        })
    })
    $(".btn-login").click(() => {
        $.ajax({
            type: "POST",
            dataType: "json",
            url: "src/usuarios/login",
            data: $("#form-login").serialize()
        }).done((retorno) => {
            var statusBtn = true;
            if (retorno.icone == "success") {
                statusBtn = false
                $("input").val("")
                setTimeout(() => {
                    $(location).attr("href", "menu")
                }, 1150);
            }
            Swal.fire({
                icon: retorno.icone,
                html: `<h2 style="color:white;">${retorno.msg}</h2>`,
                background: "rgb(39, 39, 61)",
                showConfirmButton: statusBtn,
                allowOutsideClick: false
            })
        })
    })
    $(".seletor").change(() => {
        if ($("select").val() == $($("option")[1]).val()) {
            $(".img").attr("src", "assets/img/alunos.svg")
            $("#rm").show(500)
            $("#ra").hide(250)
            $("#ra").attr("disabled", true)
            $("#rm").attr("disabled", false)
            $("#ra").val("")
        } else if ($("select").val() == $($("option")[0]).val()) {
            $(".img").attr("src", "assets/img/professores.svg")
            $("#rm").hide(250)
            $("#ra").show(500)
            $("#ra").attr("disabled", false)
            $("#rm").attr("disabled", true)
            $("#rm").val("")
        }
    })
})