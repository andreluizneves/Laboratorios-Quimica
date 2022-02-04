$(".toggle-btn").click(() => {
    $(".sidebar").toggleClass("active");
    $($("i")[0]).toggleClass("d-block");
    $($("i")[1]).toggleClass("d-none");
});
$(".btn-top").click(() => {
    $("html, body").animate({ scrollTop: $("body").offset().top }, 0);
});
$(".btn-menu").click(() => {
    $(location).attr("href", "menu");
});
$(".btn-equipament").click(() => {
    $(location).attr("href", "equipament");
});
$(".btn-reagents").click(() => {
    $(location).attr("href", "reagents");
});
$(".btn-reports").click(() => {
    $(location).attr("href", "reports");
});
$(".btn-glassworks").click(() => {
    $(location).attr("href", "glassworks");
});
$(".btn-broken-glassware").click(() => {
    $(location).attr("href", "broken-glassware");
});