function SweetAlert(icone, msg) {
    Swal.fire({
        icon: icone,
        html: `<h2 style="color:white;">${msg}</h2>`,
        background: "rgb(39, 39, 61)",
        allowOutsideClick: false,
    })
}

function ShowCards(dados, velocidade) {
    $(".itens").empty()
    $(".itens").append(dados)
    var itens = $(".coluna-card").length
    var i = 0
    var show = setInterval(() => {
        if (i <= itens) {
            $($(".coluna-card")[i]).show(velocidade)
            i++
        } else {
            clearInterval(show)
        }
    }, 200)
}

function Form(entidade) {
    $.ajax({
        url: `src/${entidade.replace("vidraria-", "vidrarias-")}s/ajax/load-form`,
        type: "POST",
        data: { entidade: entidade }
    }).done((form) => {
        entidade = entidade == "relatorio" ? "relatório" : entidade
        $(".itens").empty()
        $(".itens").append(form)
        $(".col-form, .col-btn, .col-list").toggleClass("d-none")
        $(".text-titulo").text(`CATALOGAR ${entidade.replace("vidraria-", "vidraria ")}`)
        $("#pesquisa").attr("disabled", true)
        $("#pesquisa").attr("readonly", true)
        $("#pesquisa").val("")
        setTimeout(() => {
            $(".formulario").show("slow")
        }, 500)
    })
}

function List(entidade) {
    // Faz uma limpeza da entidade, tornando-o minusculo, eliminando espaços e transformando um caso em plural
    entidade = entidade.toLowerCase().replace("ó", "o").replace("vidraria-quebrada", "vidrarias-quebradas").replace(" ", "-")
    $.ajax({
        url: `src/${entidade}/ajax/list-${entidade}`,
        type: "POST"
    }).done(dados => { ShowCards(dados, null) })
}

function Create(entidade) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: `src/${entidade}s/ajax/new-${entidade.replace("vidrarias", "vidraria")}`,
        async: true,
        data: new FormData($($("form"))[1]),
        nimeType: "multipart/form-data",
        cache: false,
        contentType: false,
        processData: false,
    }).done((retorno) => {
        SweetAlert(retorno.icone, retorno.msg)
        if (retorno.icone == "success") {
            $("input, select, textarea").val("")
        }
    });
}

function CreateRelatorio() {
    var equipamentos = []
    var reagentes = []
    var vidrarias = []

    var array = $(".select-relatorio-equipamento[selecionado='true']")
    for (let i = 0; i < array.length; i++) {
        const id = $(array[i]).attr("id");
        equipamentos.push(id)
    }

    var array = $(".select-relatorio-reagente[selecionado='true']")
    for (let i = 0; i < array.length; i++) {
        const id = $(array[i]).attr("id");
        const usado = $(array[i]).find(".quantidade-usada").val();
        reagentes.push([id, usado])
    }

    var array = $(".select-relatorio-vidraria[selecionado='true']")
    for (let i = 0; i < array.length; i++) {
        const id = $(array[i]).attr("id");
        vidrarias.push(id)
    }
    $.ajax({
        url: "src/relatorios/ajax/new-relatorio",
        dataType: "json",
        type: "POST",
        data: {
            titulo: $("#titulo").val(),
            data: $("#form-data").val(),
            hora: $("#form-hora").val(),
            laboratorio: $("#form-laboratorio").val(),
            aulas: $("#form-aulas").val(),
            descricao: $("#form-descricao").val(),
            equipamentos: equipamentos,
            reagentes: reagentes,
            vidrarias: vidrarias,
        }
    }).done((retorno) => {
        SweetAlert(retorno.icone, retorno.msg)
        if (retorno.icone == "success") {
            setTimeout(() => {
                List("relatorios")
            }, 1000)
        }
    })
}

function View(entidade, id, editavel) {
    $.ajax({
        url: `src/${entidade.replace("vidraria-", "vidrarias-")}s/ajax/view-${entidade}`,
        data: { id: id, editavel: editavel },
        type: "POST"
    }).done((dados) => {
        $(".modal-content").empty()
        $(".modal-content").append(dados)
        $("#modal").modal("show")
    })
}

function Delete(entidade, id) {
    Swal.fire({
        html: `<h2 style="color: white;"> Deseja excluir esse(a) ${entidade.replace("vidraria-", "vidraria ")}? </h2>`,
        background: "rgb(39, 39, 61)",
        icon: "question",
        showCancelButton: true,
        allowOutsideClick: false,
        confirmButtonText: "Sim",
        confirmButtonColor: "#d9534f",
        cancelButtonText: "Não",
        cancelButtonColor: "#f0ad4e"
    }).then((result) => {
        if (result.value) {
            $.ajax({
                data: `id_${entidade.replace("relatorio", "relatório").replace("vidraria-", "vidraria_")}=${id}`,
                type: "POST",
                dataType: "json",
                url: `src/${entidade.replace("vidraria-", "vidrarias-")}s/ajax/delete-${entidade}`,
            }).done((retorno) => {
                SweetAlert(retorno.icone, retorno.msg)
                if (retorno.icone == "success") {
                    $(".modal").modal("hide")
                    $(`.coluna-card[id="${id}"]`).hide("slow")
                    setTimeout(() => {
                        $(`.coluna-card[id="${id}"]`).remove()
                        if ($(".coluna-card").length == 0) {
                            $("input").val("")
                            List(document.title)
                        }
                    }, 600)
                }
            })
        }
    })
}

function Update(entidade) {
    $.ajax({
        type: "POST",
        dataType: "json",
        url: `src/${entidade}s/ajax/update-${entidade.replace("vidrarias", "vidraria")}`,
        async: true,
        data: new FormData($($("form"))[1]),
        nimeType: "multipart/form-data",
        cache: false,
        contentType: false,
        processData: false,
        success: (retorno) => {
            SweetAlert(retorno.icone, retorno.msg)
            if (retorno.icone == "success") {
                $(".modal").modal("hide")
                $("input").val("")
                $(".itens").empty()
                List(document.title)
                $(".modal-content").empty()
            }
        }
    })
}

function Pesquisa(entidade) {
    $.ajax({
        url: `src/${entidade.replace("vidraria-", "vidrarias-")}s/ajax/search-${entidade}`,
        data: { filtro: $("#pesquisa").val() },
        type: "POST"
    }).done((dados) => {
        $(".itens").empty()
        $(".itens").append(dados)
        ShowCards(dados, 200)
    })
}