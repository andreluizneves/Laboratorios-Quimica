$(".toggle-btn").click(() => {
    $("#sidebar2").toggleClass("active")
    $("#seta2").toggleClass("d-none")
    $("#seta").toggleClass("d-block")
})
$("#botao-modal").click(() => {
    $(".modal").modal("show")
})
$("#fechar-modal").click(() => {
    $(".modal").modal("hide")
})
$(".btn-menu").click(() => {
    $(location).attr("href", "menu")
})
$(".btn-equipamentos").click(() => {
    $(location).attr("href", "equipamentos")
})
$(".btn-reagentes").click(() => {
    $(location).attr("href", "reagentes")
})
$(".btn-relatorios").click(() => {
    $(location).attr("href", "relatorios")
})
$(".btn-vidrarias").click(() => {
    $(location).attr("href", "vidrarias")
})
$(".btn-vidrarias-quebradas").click(() => {
    $(location).attr("href", "vidrarias-quebradas")
})