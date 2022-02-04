$(document).ready(() => {
    $("#rm, #ra").mask("99999");
    $(".btn-login").click(() => {
        VerifyFields($("form").serializeArray());
        Ajax("services/login", "json", $("form").serialize(), response => {
            SweetAlert(response.icon, response.msg);
            Redirect(response.icon, "menu");
        });
    });
    $(".btn-register").click(() => {
        VerifyFields($("form").serializeArray());
        Ajax("services/register", "json", $("form").serialize(), response => {
            SweetAlert(response.icon, response.msg);
            Redirect(response.icon, "menu");
        });
    });
    $("select").change(() => {
        if ($("select").val() == $($("option")[1]).val()) {
            $("img").attr("src", "assets/img/students.svg");
            $("#rm").show(250);
            $("#ra").hide(250);
            $("#ra").attr("disabled", true);
            $("#rm").attr("disabled", false);
            $("#ra").val("");
        } else {
            $("img").attr("src", "assets/img/teachers.svg");
            $("#rm").hide(250);
            $("#ra").show(250);
            $("#ra").attr("disabled", false);
            $("#rm").attr("disabled", true);
            $("#rm").val("");
        }
    });
});