$(document).ready(() => {

    // FUNÇÕES INICIAIS
    onload = () => {
        $("body").css("visibility", "visible")
        $("button").attr("disabled", true)
    }

    setTimeout(() => {
        $("button").attr("disabled", false)
        List(document.title)
    }, 750)

    // MÁSCARAS
    $("#patrimonio, #quantidade, #quantidade-quebrada").mask("9999")

    // CRUD DAS ENTIDADES: EQUIPAMENTO, REAGENTE, RELATÓRIO, VIDRARIA E VIDRAIRA QUEBRADA
    $(".itens").on("click", ".card[view!='relatorio']", function(e) {
        if (e.target.nodeName == "BUTTON") {
            e.preventDefault()
        } else {
            View($(this).attr("entidade"), $(this).attr("id"), true)
        }
    })
    $(".itens").on("click", ".btn-edit", function() {
        View($(this).attr("entidade"), $(this).attr("id"), false)
    })
    $(".itens").on("click", ".btn-delete", function() {
        Delete($(this).attr("entidade"), $(this).attr("id"))
    })
    $(".itens").on("click", ".btn-send", function() {
        Create($(this).attr("entidade"))
    })
    $(".modal-content").on("click", ".btn-update", function() {
        Update($(this).attr("entidade"))
    })
    $(".itens").on("click", ".btn-new-relatorio", () => {
        CreateRelatorio()
    })

    // PESQUISA
    $("#pesquisa").keyup(function() {
        Pesquisa($(this).attr("entidade"))
    })

    // OUTRAS FUNÇÕES COMO TROCA PARA FORMULÁRIO, LISTAGEM E FECHAMENTO DE MODAL
    $(".modal-content").on("click", ".btn-fechar", () => {
        $(".modal").modal("hide")
        $(".modal-content").empty()
    })
    $(".itens").on("click", ".btn-ok", () => {
        $(".modal").modal("hide")
    })
    $(".btn-form").click(() => {
        Form($(".btn-form").attr("entidade"))
    })
    $(".btn-list").click(function() {
        List($(".btn-list").attr("entidade").replace("quebradas", "quebrada"))
        $(".text-titulo").text($(this).attr("entidade").replace("-", " "))
        $(".col-form, .col-btn, .col-list").toggleClass("d-none")
        $("#pesquisa").attr("disabled", false)
        $("#pesquisa").attr("readonly", false)
        $("#pesquisa").val("")
    })
    $(".itens").on("click", ".select-relatorio-equipamento", function() {
        if ($(this).attr("selecionado") == "true") {
            $(this).attr("selecionado", false)
        } else {
            $(this).attr("selecionado", true)
        }
    })
    $(".itens").on("click", ".select-relatorio-reagente", function(e) {
        if (e.target.nodeName == "INPUT") {
            e.preventDefault()
        } else {
            if ($(this).attr("selecionado") == "true") {
                $(this).attr("selecionado", false)
                $(this).find(".linha-quantidade").toggleClass("d-none")
            } else {
                $(this).attr("selecionado", true)
                $(this).find(".linha-quantidade").toggleClass("d-none")
            }
        }
    })
    $(".itens").on("click", ".select-relatorio-vidraria", function() {
        if ($(this).attr("selecionado") == "true") {
            $(this).attr("selecionado", false)
        } else {
            $(this).attr("selecionado", true)
        }
    })
    $(".itens").on("click", ".btn-selecionar-equipamentos", () => {
        $("#modal-equipamentos").modal("show")
    })
    $(".itens").on("click", ".btn-selecionar-reagentes", () => {
        $("#modal-reagentes").modal("show")
    })
    $(".itens").on("click", ".btn-selecionar-vidrarias", () => {
        $("#modal-vidrarias").modal("show")
    })
})